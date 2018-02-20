<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
       <h1>File Upload</h1>
            <form method="post" enctype="multipart/form-data">
                <label>Select image to upload:</label>
                <input accept="image/*" type="file" name="file" id="file" onchange="imageUploader(this.files)">
                <input type="submit" value="Upload" name="submit">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            </form>


        <script type="text/javascript">
            var imageValidator = function(images) {
                var uploadedImage = images[0];
                var maxSize = 5;
                var allowedExtensions = ['jpeg','png', 'bmp'];
                var imageType = uploadedImage.type.replace("image/", "");
                console.log(imageType);
                if(uploadedImage.size/1024/1024 > maxSize) {
                    return {
                        status: "False",
                        errorMessage: "File Size Exceeded",
                        displayMessage: "Please upload a file less than " + maxSize + " Mb",
                    }
                }
                if(!allowedExtensions.includes(imageType)){
                    
                }
            }
            var imageUploader = function(images) {
                var imageStatus = imageValidator(images);
            }
        </script>     
    </body>
</html>
