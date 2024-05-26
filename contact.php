<?php
session_start();
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Embed in HNB</title>
    <link rel="stylesheet" href="css/maps.css">
    <style>
        /* Any additional styles specific to this page can be added here */
    </style>
</head>

<body>  
    <div class="container">
        <h1>Himalyang Pilipino Memorial Park Map</h1>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5801.809947650999!2d121.04995534561812!3d14.682603960843778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0cb260299bf%3A0x9dcfa64b6e999995!2sHimlayang%20Pilipino%2C%20Inc.%20-%20Memorial%20Park%20Office!5e0!3m2!1sen!2sph!4v1714648726015!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</body>
</html>  -->

<!--<!DOCTYPE html>
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

        .image-container img {
            width: 100%;
            height: 100%;
        }

        .image-btn {
            position: absolute;
            background-color: red;
            color: white;
            font-size: 14px;
            padding: 5px;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 20px;
        }

        .image-btn:hover {
            background-color: darkred;
        }

        .image-btn1 {
            top: 10%;
            left: 10%;
        }

        .image-btn2 {
            top: 10%;
            left: 20%;
        }

        .image-btn3 {
            top: 10%;
            left: 30%;
        }

        .image-btn4 {
            top: 10%;
            left: 40%;
        }
        .image-btn5 {
            top: 20%;
            left: 10%;
        }

        .image-btn6 {
            top: 20%;
            left: 20%;
        }

        .image-btn7 {
            top: 20%;
            left: 30%;
        }

        .image-btn8 {
            top: 20%;
            left: 40%;
        }
        .image-btn9 {
            top: 30%;
            left: 10%;
        }

        .image-btn10 {
            top: 30%;
            left: 20%;
        }

        .image-btn11 {
            top: 30%;
            left: 30%;
        }

        .image-btn12 {
            top: 30%;
            left: 40%;
        }
        .image-btn13 {
            top: 40%;
            left: 10%;
        }

        .image-btn14 {
            top: 40%;
            left: 20%;
        }

        .image-btn15 {
            top: 40%;
            left: 30%;
        }

        .image-btn16 {
            top: 40%;
            left: 40%;
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

     Modals for the map 
    <div id="myModal1" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="myModal1">&times;</span>
            <div class="image-container">
                <img src="img_snow.jpg" alt="Snow">
                <button class="image-btn image-btn1">+</button>
                <button class="image-btn image-btn2">+</button>
                <button class="image-btn image-btn3">+</button>
                <button class="image-btn image-btn4">+</button>
            </div>
        </div>
    </div>

    <div id="myModal2" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="myModal2">&times;</span>
            <div class="image-container">
                <img src="img_snow.jpg" alt="Snow">
                <button class="image-btn image-btn5">+</button>
                <button class="image-btn image-btn6">+</button>
                <button class="image-btn image-btn7">+</button>
                <button class="image-btn image-btn8">+</button>
            </div>
        </div>
    </div>

    <div id="myModal3" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="myModal3">&times;</span>
            <div class="image-container">
                <img src="img_snow.jpg" alt="Snow">
                <button class="image-btn image-btn9">+</button>
                <button class="image-btn image-btn10">+</button>
                <button class="image-btn image-btn11">+</button>
                <button class="image-btn image-btn12">+</button>
            </div>
        </div>
    </div>

    <div id="myModal4" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="myModal4">&times;</span>
            <div class="image-container">
                <img src="img_snow.jpg" alt="Snow" style="width: 100%; height: auto;">
                <div class="grid-container">
                     6x10 grid of buttons 
                    <script>
                        for (let i = 0; i < 60; i++) {
                            document.write('<button>+</button>');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Modal script
        var modal = document.getElementById("myModal4");
        var span = document.getElementsByClassName("close")[0];
    
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

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
</html>-->