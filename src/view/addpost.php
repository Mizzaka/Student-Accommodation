<?php

session_start();

if(!($_SESSION['user_type'] == 'landlord' && isset($_SESSION['user']))){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style/style.css">
<title>Student Accommodation - NSBM</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #34CC33;
    }
    table {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    table-layout: fixed;
}

    label {
        font-weight: bold;
    }
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }
    .file-input-wrapper input[type="file"] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }
    input[type="text"],
    input[type="tel"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="tel"]:focus,
    input[type="number"]:focus,
    select:focus,
    textarea:focus {
        border-color: #FDC825;
    }
    input[type="submit"] {
        background-color: #34CC33;
        color: #fff;
        border: none;
        border-radius: 50px;
        cursor: pointer;
    
        font-weight:500;
        max-width: max-content;
        padding: 12px 28px;
    }
    input[type="submit"]:hover {
        background-color: #ff7e00;
        border-color: #ff7e00;
        transition: 0.2s ease;
    }
    .image-preview {
        display: flex;
        flex-wrap: wrap;
    }
    .image-preview img {
        width: 100px;
        height: auto;
        max-width: 200px;
        max-height: 200px;
        margin-right: 10px;
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    #photos1-container {

    margin-left: 90px;
    }


</style>
</head>
<body>

<div class="container">
    <h2>Post your Ad</h2>
    <form action="../controller/addPostController.php" method="post" enctype="multipart/form-data">

    <table>
            <tr>
                <td><label for="photos">Upload images:</label></td>
                <td></td>
            </tr>
            <tr>
                <td style="background-color: #bbbaba; border-radius: 0.5rem;">
                    <br>
                    <div id="photos1-container" class="file-input-wrapper">
                        <input type="file" id="photos1" name="photos[]" accept="image/*" required>
                        <span class="file-input-label" style="display: flex; margin-bottom: 20px; ">click here to add</span>
                        <div id="preview1" class="image-preview"></div>
                    </div>
                </td>
                <td style="background-color: #bbbaba; border-radius: 0.5rem;">
                    <br>
                    <div id="photos1-container" class="file-input-wrapper">
                        <input type="file" id="photos2" name="photos[]" accept="image/*" required>
                        <span class="file-input-label" style="display: flex; margin-bottom: 20px; ">click here to add</span>
                        <div id="preview2" class="image-preview"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="background-color: #bbbaba; border-radius: 0.5rem;">
                    <br>
                    <div id="photos1-container" class="file-input-wrapper">
                        <input type="file" id="photos3" name="photos[]" accept="image/*" required>
                        <span class="file-input-label" style="display: flex; margin-bottom: 20px; ">click here to add</span>
                        <div id="preview3" class="image-preview"></div>
                    </div>
                </td>
                <td style="background-color: #bbbaba; border-radius: 0.5rem;">
                    <br>
                    <div id="photos1-container" class="file-input-wrapper">
                        <input type="file" id="photos4" name="photos[]" accept="image/*" required>
                        <span class="file-input-label" style="display: flex; margin-bottom: 20px; margin-left: 0px;">click here to add</span>
                        <div id="preview4" class="image-preview"></div>
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-top: -42px;">
            <tr>
            </tr>
            <tr>
                <td style="background-color: #bbbaba; border-radius: 0.5rem;">
                    <br>
                    <div id="photos1-container" class="file-input-wrapper">
                        <input type="file" id="photos5" name="photos[]" accept="image/*" required>
                        <span class="file-input-label" style="display: flex; margin-bottom: 20px; margin-left: 120px;">click here to add</span>
                        <div id="preview5" class="image-preview"></div>
                    </div>
                </td>
                
            </tr>
        </table>


        <label for="location">Title: <span style="color: red">*</span></label>
        <input type="text" id="location" name="location" required><br>

        <label for="beds">Beds: <span style="color: red">*</span></label>
        <select id="beds" name="beds" required>
            <option value="">Select an option</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br>

        <label for="baths">Baths: <span style="color: red">*</span></label>
        <select id="baths" name="baths" required>
            <option value="">Select an option</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select><br>

        <label for="category">Category: <span style="color: red">*</span></label>
        <select id="category" name="category" required>
            <option value="">Choose category</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select><br>

        <label for="phone">Phone: <span style="color: red">*</span></label>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="price">Price: <span style="color: red">*</span></label>
        <input type="text" id="price" name="price" required><br>

        <label for="latitude">Latitude: <span style="color: red">*</span></label>
        <input type="text" id="latitude" name="latitude" required><br>

        <label for="longitude">Longitude: <span style="color: red">*</span></label>
        <input type="text" id="longitude" name="longitude" required><br>

        <label for="description">Description: <span style="color: red">*</span></label>
        <textarea id="description" name="description" rows="5" required style="resize: none;"></textarea><br>

        <input type="submit" value="Post my Ad" name="addpost" class="btn btn-secondary">
    </form>

    <!-- Preview area for images -->
    <div id="image-preview"></div>
</div>

<script>
    // Change border color on input focus
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#FDC825';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#ccc';
        });
    });

    // Preview uploaded images and hide labels
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const files = this.files;
            const previewId = this.id.replace('photos', 'preview');
            const preview = document.getElementById(previewId);
            const label = this.nextElementSibling; // Get the label element

            preview.innerHTML = ''; // Clear previous preview
            label.style.display = 'none'; // Hide the label

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.maxWidth = '200px';
                    img.style.maxHeight = '200px';
                    img.style.marginRight = '10px';
                    img.style.marginBottom = '10px';
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>



</body>
</html>
