const preview = document.getElementById("preview");
const imageField = document.getElementById("image-field");
placeholder =
    "https://cdn2.vectorstock.com/i/thumb-large/48/06/image-preview-icon-picture-placeholder-vector-31284806.jpg";

imageField.addEventListener("input", () => {
    if (imageField.value) preview.src = imageField.value;
    else preview.src = placeholder;
});
