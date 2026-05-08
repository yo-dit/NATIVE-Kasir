//menyetel margin dan warna bg
document.body.style.background = "linear-gradient(#FCDB97,#8F6640)";
document.body.style.margin = "50px";

const fileInput = document.getElementById('image');
const preview = document.getElementById('preview');
const dropArea = document.getElementById('drop-area');

// CLICK → FILE EXPLORER
if (dropArea && fileInput) {
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });
}

// FILE INPUT CHANGE
if (fileInput) {
    fileInput.addEventListener('change', () => {
        previewFile(fileInput.files[0]);
    });
}

// DRAG & DROP
if (dropArea) {
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragover');
    });
    
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('dragover');

        const file = e.dataTransfer.files[0];
        if (!file) return;

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;

        previewFile(file);
    });
}

// COPY & PASTE (Ctrl+V)
document.addEventListener('paste', (e) => {
    if (!fileInput || !preview) return;

    const items = e.clipboardData.items;

    for (let item of items) {
        if (item.type.startsWith('image')) {
            const file = item.getAsFile();

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            previewFile(file);
        }
    }
});

// PREVIEW FUNCTION
function previewFile(file) {
    if (!file || !file.type.startsWith('image/')) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
}
