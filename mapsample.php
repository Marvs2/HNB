<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Embed in HNB</title>
    <link rel="stylesheet" href="css/maps.css">
    <style>
        .container {
            position: relative;
            width: 600px;
            height: 450px;
            margin: auto;
        }

        .container iframe {
            width: 100%;
            height: 100%;
        }

        .btn {
            position: absolute;
            background-color: blue;
            color: white;
            font-size: 14px;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 20px;
        }

        .btn:hover {
            background-color: darkblue;
        }

        .btn1 {
            top: 42%;
            left: 45%;
        }

        .btn2 {
            top: 48%;
            right: 40%;
        }

        .btn3 {
            bottom: 35%;
            left: 33%;
        }

        .btn4 {
            bottom: 28%;
            right: 38%;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 400px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50%;
        }

        .grid-container button {
            width: 40px;
            height: 40px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid-container button:nth-child(odd) {
            background-color: #4CAF50;
        }

        .grid-container button:nth-child(even) {
            background-color: #2196F3;
        }

        .image-container img {
            width: 100%;
            height: 90%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Himalyang Pilipino Memorial Park Map</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5801.809947650999!2d121.04995534561812!3d14.682603960843778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0cb260299bf%3A0x9dcfa64b6e999995!2sHimlayang%20Pilipino%2C%20Inc.%20-%20Memorial%20Park%20Office!5e0!3m2!1sen!2sph!4v1714648726015!5m2!1sen!2sph&gestureHandling=none&scrollwheel=false&disableDefaultUI=true" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <button class="btn btn1" id="modalBtn1">+</button>
        <button class="btn btn2" id="modalBtn2">+</button>
        <button class="btn btn3" id="modalBtn3">+</button>
        <button class="btn btn4" id="modalBtn4">+</button>
    </div>
    
<!-- Modals for the map -->
<div id="myModal1" class="modal">
    <div class="modal-content">
       <div class="image-container" style="position: relative; width: 100%;">
            <img src="img_snow.jpg" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <!-- Add circular buttons for modal content -->
            <button class="image-btn image-btn1" style="position: absolute; top: 30%; left: 20%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn2" style="position: absolute; top: 60%; left: 50%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn3" style="position: absolute; top: 20%; left: 80%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn4" style="position: absolute; top: 70%; left: 30%; border-radius: 50%; width: 40px; height: 40px;">+</button>
        </div>
    </div>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <div class="image-container" style="position: relative; width: 100%;">
            <img src="img_snow.jpg" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <!-- Add circular buttons for modal content -->
            <button class="image-btn image-btn5" style="position: absolute; top: 40%; left: 30%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn6" style="position: absolute; top: 70%; left: 60%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn7" style="position: absolute; top: 20%; left: 80%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn8" style="position: absolute; top: 60%; left: 40%; border-radius: 50%; width: 40px; height: 40px;">+</button>
        </div>
    </div>
</div>

<div id="myModal3" class="modal">
    <div class="modal-content">
        <!--<span class="close" data-modal="myModal3">&times;</span>-->
        <div class="image-container" style="position: relative; width: 100%;">
            <img src="img_snow.jpg" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <!-- Add circular buttons for modal content -->
            <button class="image-btn image-btn9" style="position: absolute; top: 20%; left: 20%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn10" style="position: absolute; top: 50%; left: 50%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn11" style="position: absolute; top: 80%; left: 80%; border-radius: 50%; width: 40px; height: 40px;">+</button>
            <button class="image-btn image-btn12" style="position: absolute; top: 30%; left: 30%; border-radius: 50%; width: 40px; height: 40px;">+</button>
        </div>
    </div>
</div>


<div id="myModal4" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="myModal4">&times;</span>
        <div class="image-container">
            <!--<img src="img_snow.jpg" alt="Snow">-->
            <div class="grid-container" id="buttonGrid">
                <!-- Buttons will be generated here -->
            </div>
        </div>
    </div>
</div>

<!-- Individual modals will be generated here -->
<div id="modalsContainer"></div>

<script>
    // Function to open modals
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    // Function to close modals
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Add event listeners for buttons to open modals
    document.getElementById('modalBtn1').onclick = function() { openModal('myModal1'); }
    document.getElementById('modalBtn2').onclick = function() { openModal('myModal2'); }
    document.getElementById('modalBtn3').onclick = function() { openModal('myModal3'); }
    document.getElementById('modalBtn4').onclick = function() { openModal('myModal4'); }

    // Generate buttons and their corresponding modals for modal 4
    for (let i = 13; i <= 42; i++) {
        // Create button
        const button = document.createElement('button');
        button.textContent = i;
        button.onclick = function() { openModal('myModal' + i); }
        document.getElementById('buttonGrid').appendChild(button);

        // Create corresponding modal
        const modal = document.createElement('div');
        modal.id = 'myModal' + i;
        modal.className = 'modal';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close" data-modal="myModal${i}">&times;</span>
                <p>Content for Modal ${i}</p>
            </div>
        `;
        document.getElementById('modalsContainer').appendChild(modal);
    }

    // Add event listeners for close buttons to close modals
    var closeButtons = document.getElementsByClassName('close');
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].onclick = function() {
            closeModal(this.getAttribute('data-modal'));
        }
    }

    // Close the modal when the user clicks outside of it
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = "none";
        }
    }
</script>
</body>
</html>
