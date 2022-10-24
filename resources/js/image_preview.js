 const placeholder =
        "https://cdn2.vectorstock.com/i/thumb-large/48/06/image-preview-icon-picture-placeholder-vector-31284806.jpg"
    const image = document.getElementById('image')
    const preview = document.getElementById('preview')

    image.addEventListener('input', () => {
        if (image.files && image.files[0]) {
            let reader = new FileReader();
            reader.readAsDataURL(image.files[0]);
            reader.addEventListener('load', event => {
                preview.src = event.target.result;
            });
        } else preview.src = placeholder;
        preview.setAttribute('src', placeholder);
    })