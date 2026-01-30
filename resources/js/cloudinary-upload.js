/**
 * Client-side Image Compression
 * Compresses images before upload to avoid Heroku's 30-second timeout
 */

const MAX_WIDTH = 1920;
const MAX_HEIGHT = 1080;
const QUALITY = 0.8;
const MAX_FILE_SIZE = 500 * 1024; // 500KB target

/**
 * Compress an image file
 * @param {File} file - The image file to compress
 * @returns {Promise<File>} - Compressed image file
 */
async function compressImage(file) {
    // Skip if not an image
    if (!file.type.startsWith('image/')) {
        return file;
    }

    // Skip small files
    if (file.size < MAX_FILE_SIZE) {
        return file;
    }

    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = (event) => {
            const img = new Image();
            img.src = event.target.result;

            img.onload = () => {
                const canvas = document.createElement('canvas');
                let { width, height } = img;

                // Calculate new dimensions
                if (width > MAX_WIDTH || height > MAX_HEIGHT) {
                    const ratio = Math.min(MAX_WIDTH / width, MAX_HEIGHT / height);
                    width = Math.round(width * ratio);
                    height = Math.round(height * ratio);
                }

                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                // Convert to blob
                canvas.toBlob(
                    (blob) => {
                        if (blob) {
                            const compressedFile = new File([blob], file.name, {
                                type: 'image/jpeg',
                                lastModified: Date.now(),
                            });
                            console.log(`Compressed: ${(file.size / 1024).toFixed(1)}KB -> ${(compressedFile.size / 1024).toFixed(1)}KB`);
                            resolve(compressedFile);
                        } else {
                            resolve(file);
                        }
                    },
                    'image/jpeg',
                    QUALITY
                );
            };

            img.onerror = () => resolve(file);
        };

        reader.onerror = () => resolve(file);
    });
}

/**
 * Setup compression for all file inputs
 */
function setupImageCompression() {
    document.querySelectorAll('input[type="file"][accept*="image"]').forEach(input => {
        // Skip if already processed
        if (input.dataset.compressionEnabled) return;
        input.dataset.compressionEnabled = 'true';

        input.addEventListener('change', async function (e) {
            const files = Array.from(this.files);
            if (files.length === 0) return;

            // Create compressed files
            const compressedFiles = await Promise.all(
                files.map(file => compressImage(file))
            );

            // Create a new FileList-like object
            const dataTransfer = new DataTransfer();
            compressedFiles.forEach(file => dataTransfer.items.add(file));

            // Replace the input files with compressed versions
            this.files = dataTransfer.files;

            // Trigger preview update if there's a preview function
            if (typeof previewImage === 'function') {
                const onchangeAttr = this.getAttribute('onchange');
                if (onchangeAttr) {
                    const match = onchangeAttr.match(/previewImage\(this,\s*'([^']+)'\)/);
                    if (match) {
                        previewImage(this, match[1]);
                    }
                }
            }
        });
    });
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', setupImageCompression);

// Re-run when new dynamic content is added
const observer = new MutationObserver(setupImageCompression);
observer.observe(document.body, { childList: true, subtree: true });
