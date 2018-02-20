<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Image Upload</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
       <h1>File Upload</h1>
            <!-- <form method="post" enctype="multipart/form-data"> -->
                <label>Select image to upload:</label>
                <input accept="image/*" type="file" name="file" id="file" onchange="imageUploader(this.files)">
                <button value="Upload" name="submit" id="submitButton" disabled>Submit</button>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <!-- </form> -->
            <div id="previewBox">
            </div>


        <script type="text/javascript">
            var imageValidator = function(images) {
                var uploadedImage = images[0];
                var maxSize = 5;
                var allowedExtensions = ['jpeg','png', 'bmp', 'jpg'];
                var imageType = uploadedImage.type.replace("image/", "");
                if(uploadedImage.size/1024/1024 > maxSize) {
                    return {
                        status: false,
                        errorMessage: "File Size Exceeded",
                        displayMessage: "Please upload a file less than " + maxSize + " Mb",
                    }
                }
                if(!allowedExtensions.includes(imageType)){
                    return {
                        status: false,
                        errorMessage: "Image extenstion not supported",
                        displayMessage: "Please upload an image of jpeg/bmp/png extension",
                    }
                }
                return true;
            }
            var imageUploader = function(images) {
                var imageStatus = imageValidator(images);
                if(false == imageStatus.status) {
                    document.getElementById("previewBox").innerHTML += imageStatus.displayMessage;
                    document.getElementById("submitButton").setAttribute("disabled", "true");
                }
                else {
                    document.getElementById("submitButton").removeAttribute("disabled");
                    var img = document.createElement("img");
                    img.classList.add("imagePreview");
                    img.file = images[0];
                    document.getElementById("previewBox").appendChild(img);

                    var reader = new FileReader();
                    reader.onload = (function(previewImage) {
                        return function(e) {
                            console.log(e);
                            previewImage.src = e.target.result;
                        };
                    })(img);
                    reader.readAsDataURL(images[0]);

                    document.getElementById("submitButton").addEventListener('click', function(e){
                        e.stopPropagation();
                        e.preventDefault();
                        var uri = "{{ URL::to('upload') }}";
                        var xhr = new XMLHttpRequest();
                        var fd = new FormData();

                        xhr.open("POST", uri, true);
                        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}')
                        fd.append('image', images[0]);
                        xhr.send(fd);
                    }, false)
                }
            }
        </script>     
    </body>
</html>
