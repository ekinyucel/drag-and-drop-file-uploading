<!DOCTYPE html>
<html xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Drag & Drop</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div id="uploads"></div>
    <div class="dropzone" id="dropzone">Drop files here to upload</div>
    <script>
        (function() {            
            var dropzone = document.getElementById('dropzone');
            
            var displayUploads = function(data){
                var uploads = document.getElementById('uploads'),
                        img,
                        x;
                for(x = 0; x < data.length; x = x+1){
                      var link = data[x].file;
                      var name = data[x].name;
                      
                      img = document.createElement("img");
                      img.src = link;
                      img.setAttribute("class","image");
                      img.setAttribute("alt", name);
                      uploads.appendChild(img);
                }
            };
            
            var upload = function(files){
                var formData = new FormData(),
                        xhr = new XMLHttpRequest(),
                        x;
                
                for(x=0; x < files.length; x = x+1){
                    formData.append('file[]',files[x]);
                }
                
                xhr.onload = function(){
                    var data = JSON.parse(this.responseText);
                    displayUploads(data);
                };  
                // post metodu kullanarak upload.php üzerinden dosyayı kaydet
                xhr.open('post','upload.php');
                xhr.send(formData);
            };
            
            dropzone.ondrop = function(e){
                e.preventDefault();
                this.className = 'dropzone';
                // get file and transfer to upload function
                upload(e.dataTransfer.files);
            };
            
            dropzone.ondragover = function(){
                this.className = 'dropzone dragover';
                return false;
            };
            
            dropzone.ondragleave = function(){
                this.className = 'dropzone';
                return false;
            };
            
        }());
    </script>
</body>
</html>
