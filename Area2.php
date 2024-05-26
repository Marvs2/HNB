<?php
session_start();
?>

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
            width: 750px;
            height: 700px;
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
            top: 44%;
            left: 45%;
        }

        .btn2 {
            top: 49%;
            right: 43%;
        }

        .btn3 {
            bottom: 38%;
            left: 38%;
        }

        .btn4 {
            bottom: 37%;
            right: 40%;
        }
        .btn5 {
            top: 68%;
            left: 38%;
        }

        .btn6 {
            top: 62%;
            right: 48%;
        }

        .btn7 {
            bottom: 25%;
            left: 28%;
        }

        .btn8 {
            bottom: 18%;
            right: 55%;
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
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 800px;
            min-height: 400px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
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
            text-align: center;
        }
        .image-container img {
            max-width: 80%;
            height: auto;
        }

        .modal-button:hover {
            background-color: #d4ac0d;
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
        <button class="btn btn5" id="modalBtn5">+</button>
        <button class="btn btn6" id="modalBtn6">+</button>
        <button class="btn btn7" id="modalBtn7">+</button>
        <button class="btn btn8" id="modalBtn8">+</button>
    </div>
    
<!-- Modals for the map -->
<div id="myModal1" class="modal">
    <div class="modal-content">
       <div class="image-container" style="position: relative; width: 100%;">
        <h2>Modal Content for Button 1</h2>
            <img src="uploaded_img/AreaOne.png" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <!-- Add circular buttons for modal content -->
            <div style="position: absolute; top: 10%; left: 10%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.1</button>
            </div>
            <div style="position: absolute; top: 10%; left: 20%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.2</button>
            </div>
            <div style="position: absolute; top: 10%; left: 30%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.3</button>
            </div>
            <div style="position: absolute; top: 10%; left: 40%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.4</button>
            </div>
            <div style="position: absolute; top: 10%; left: 50%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.5</button>
            </div>
            <div style="position: absolute; top: 10%; left: 60%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.6</button>
            </div>
            <div style="position: absolute; top: 10%; left: 70%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.7</button>
            </div>
            <div style="position: absolute; top: 10%; left: 80%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.8</button>
            </div>
            <div style="position: absolute; top: 20%; left: 10%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.9</button>
            </div>
            <div style="position: absolute; top: 20%; left: 20%; width: 0; height: 0;">
                <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">1.10</button>
            </div>
            
        </div>
    </div>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <div class="image-container" style="position: relative; width: 100%;">
            <h2>Modal Content for Button 2</h2>
            <img src="AreaFive.webp" alt="Snow" style="max-width: 100%; max-height: 100%;">
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
            <h2>Modal Content for Button 3</h2>
            <img src="uploaded_img/Area1img.png" alt="Snow" style="max-width: 100%; max-height: 100%;">
            
            <!-- Wrapper divs for big buttons (small rectangles) -->
            <div style="position: absolute; top: 10%; left: 10%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 1</button>
            </div>
            <div style="position: absolute; top: 10%; left: 30%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 2</button>
            </div>
            <div style="position: absolute; top: 10%; left: 50%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 3</button>
            </div>
            <div style="position: absolute; top: 10%; left: 70%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 4</button>
            </div>
            <div style="position: absolute; top: 20%; left: 10%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 5</button>
            </div>
            <div style="position: absolute; top: 20%; left: 30%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 6</button>
            </div>
            <div style="position: absolute; top: 20%; left: 50%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">Big 7</button>
            </div>
            
            <!-- Wrapper divs for small buttons (small boxes) -->
            <div style="position: absolute; top: 40%; left: 10%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">1</button>
            </div>
            <div style="position: absolute; top: 40%; left: 15%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">2</button>
            </div>
            <div style="position: absolute; top: 40%; left: 20%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">3</button>
            </div>
            <div style="position: absolute; top: 40%; left: 25%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">4</button>
            </div>
            <div style="position: absolute; top: 40%; left: 30%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">5</button>
            </div>
            <div style="position: absolute; top: 40%; left: 35%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">6</button>
            </div>
            <div style="position: absolute; top: 40%; left: 40%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">7</button>
            </div>
            <div style="position: absolute; top: 40%; left: 45%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">8</button>
            </div>
            <div style="position: absolute; top: 40%; left: 50%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">9</button>
            </div>
            <div style="position: absolute; top: 40%; left: 55%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">10</button>
            </div>
            <div style="position: absolute; top: 40%; left: 60%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">11</button>
            </div>
            <div style="position: absolute; top: 40%; left: 65%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">12</button>
            </div>
            <div style="position: absolute; top: 40%; left: 70%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">13</button>
            </div>
            <div style="position: absolute; top: 40%; left: 75%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">14</button>
            </div>
            <div style="position: absolute; top: 40%; left: 80%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">15</button>
            </div>
            <div style="position: absolute; top: 40%; left: 85%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">16</button>
            </div>
            <div style="position: absolute; top: 40%; left: 90%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">17</button>
            </div>
            <div style="position: absolute; top: 40%; left: 95%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">18</button>
            </div>
            <div style="position: absolute; top: 45%; left: 10%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">19</button>
            </div>
            <div style="position: absolute; top: 45%; left: 15%; width: 0; height: 0;">
                <button class="small-btn" style="width: 30px; height: 30px;">20</button>
            </div>

            <!-- Existing circular buttons -->
            {{-- <div style="position: absolute; top: 20%; left: 20%; width: 0; height: 0;">
                <button class="image-btn image-btn9" style="border-radius: 50%; width: 40px; height: 40px;">+</button>
            </div>
            <div style="position: absolute; top: 50%; left: 50%; width: 0; height: 0;">
                <button class="image-btn image-btn10" style="border-radius: 50%; width: 40px; height: 40px;">+</button>
            </div>
            <div style="position: absolute; top: 80%; left: 80%; width: 0; height: 0;">
                <button class="image-btn image-btn11" style="border-radius: 50%; width: 40px; height: 40px;">+</button>
            </div>
            <div style="position: absolute; top: 30%; left: 30%; width: 0; height: 0;">
                <button class="image-btn image-btn12" style="border-radius: 50%; width: 40px; height: 40px;">+</button>
            </div> --}}
        </div>
    </div>
</div>




<div id="myModal4" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="myModal4">&times;</span>
        <h2>Modal Content for Button 4</h2>
        <div class="image-container">
            
            <!--<img src="AreaFive.webp" alt="Snow">-->
            <div class="grid-container" id="buttonGrid">
                <!-- Buttons will be generated here -->
            </div>
        </div>
    </div>
</div>

<!-- Individual modals will be generated here -->
<div id="modalsContainer"></div>

 <!-- Modals for buttons 5 to 8 -->
 <div id="myModal5" class="modal">
    <div class="modal-content">
        <div class="image-container" style="position: relative; width: 100%; height: 100%;">
            <h2>Modal Content for Button 5</h2>
            <img src="uploaded_img/AreaFive.png" alt="Snow" style="max-width: 100%; max-height: 100%;">
            <!-- Insert 10 buttons -->
            <div style="position: absolute; top: 60%; left: 10%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.1</button>
            </div>
            <div style="position: absolute; top: 62%; left: 17%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.2</button>
            </div>
            <div style="position: absolute; top: 60%; left: 24%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.3</button>
            </div>
            <div style="position: absolute; top: 63%; left: 31%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.4</button>
            </div>
            <div style="position: absolute; top: 63%; left: 38%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.5</button>
            </div>
            <div style="position: absolute; top: 63.5%; left: 45%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.6</button>
            </div>
            <div style="position: absolute; top: 61%; left: 52%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.7</button>
            </div>
            <div style="position: absolute; top: 63%; left: 58%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.8</button>
            </div>
            <div style="position: absolute; top: 67%; left: 10%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.9</button>
            </div>
            <div style="position: absolute; top: 74%; left: 10%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.10</button>
            </div>
            <div style="position: absolute; top: 73%; left: 20%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.11</button>
            </div>
            <div style="position: absolute; top: 74%; left: 26%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.12</button>
            </div>
            <div style="position: absolute; top: 75%; left: 32%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.13</button>
            </div>
            <div style="position: absolute; top: 73%; left: 37%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.14</button>
            </div>
            <div style="position: absolute; top: 72%; left: 43%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.15</button>
            </div>
            <div style="position: absolute; top: 73%; left: 49%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.16</button>
            </div>
            <div style="position: absolute; top: 73.2%; left: 55%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.17</button>
            </div>
            <div style="position: absolute; top: 58%; left: 64%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px; transform: rotate(25deg);">5.18</button>
            </div>
            <div style="position: absolute; top: 58%; left: 70%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.19</button>
            </div>
            <div style="position: absolute; top: 52%; left: 72%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.20</button>
            </div>
            <div style="position: absolute; top: 48%; left: 75%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.21</button>
            </div>
            <div style="position: absolute; top: 42%; left: 71%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.22</button>
            </div>
            <div style="position: absolute; top: 36%; left: 77%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.23</button>
            </div>
            <div style="position: absolute; top: 30%; left: 80%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.24</button>
            </div>
            <div style="position: absolute; top: 26%; left: 84%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.25</button>
            </div>
            <div style="position: absolute; top: 22%; left: 89%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.26</button>
            </div>
            <div style="position: absolute; top: 20%; left: 84%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.27</button>
            </div>
            <div style="position: absolute; top: 17%; left: 95%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.28</button>
            </div>
            <div style="position: absolute; top: 14%; left: 86%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.29</button>
            </div>
            <div style="position: absolute; top: 11%; left: 90%; width: 0; height: 0;">
                <button class="big-btn" style="width: 80px; height: 40px;">5.30</button>
            </div>
            
        </div>
    </div>
</div>

<div id="myModal6" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="myModal6">&times;</span>
        <h2>Modal Content for Button 6</h2>
        <p>This is a full-page modal for button 6.</p>
        <!-- Insert 10 buttons -->
        <div style="position: absolute; top: 10%; left: 10%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.1</button>
        </div>
        <div style="position: absolute; top: 10%; left: 20%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.2</button>
        </div>
        <div style="position: absolute; top: 10%; left: 30%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.3</button>
        </div>
        <div style="position: absolute; top: 10%; left: 40%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.4</button>
        </div>
        <div style="position: absolute; top: 10%; left: 50%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.5</button>
        </div>
        <div style="position: absolute; top: 10%; left: 60%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.6</button>
        </div>
        <div style="position: absolute; top: 10%; left: 70%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.7</button>
        </div>
        <div style="position: absolute; top: 10%; left: 80%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.8</button>
        </div>
        <div style="position: absolute; top: 20%; left: 10%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.9</button>
        </div>
        <div style="position: absolute; top: 20%; left: 20%; width: 0; height: 0;">
            <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">6.10</button>
        </div>
        
    </div>
</div>

<div id="myModal7" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="myModal7">&times;</span>
        <h2>Modal Content for Button 7</h2>
        <p>This is a full-page modal for button 7.</p>
        <!-- Insert 10 buttons -->
        <div>
            <button class="modal-button">7.1</button>
            <button class="modal-button">7.2</button>
            <button class="modal-button">7.3</button>
            <button class="modal-button">7.4</button>
            <button class="modal-button">7.5</button>
            <button class="modal-button">7.6</button>
            <button class="modal-button">7.7</button>
            <button class="modal-button">7.8</button>
            <button class="modal-button">7.9</button>
            <button class="modal-button">7.10</button>
        </div>
    </div>
</div>

<div id="myModal8" class="modal">
    <div class="modal-content">
        <span class="close" data-modal="myModal8">&times;</span>
        <h2>Modal Content for Button 8</h2>
        <p>This is a full-page modal for button 8.</p>
        <!-- Insert 10 buttons -->
         <!-- Buttons for modal 8 -->
<div style="position: absolute; top: 10%; left: 10%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.1</button>
</div>
<div style="position: absolute; top: 10%; left: 20%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.2</button>
</div>
<div style="position: absolute; top: 10%; left: 30%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.3</button>
</div>
<div style="position: absolute; top: 10%; left: 40%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.4</button>
</div>
<div style="position: absolute; top: 10%; left: 50%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.5</button>
</div>
<div style="position: absolute; top: 10%; left: 60%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.6</button>
</div>
<div style="position: absolute; top: 10%; left: 70%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.7</button>
</div>
<div style="position: absolute; top: 10%; left: 80%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.8</button>
</div>
<div style="position: absolute; top: 20%; left: 10%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.9</button>
</div>
<div style="position: absolute; top: 20%; left: 20%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.10</button>
</div>
<div style="position: absolute; top: 20%; left: 30%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.11</button>
</div>
<div style="position: absolute; top: 20%; left: 40%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.12</button>
</div>
<div style="position: absolute; top: 20%; left: 50%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.13</button>
</div>
<div style="position: absolute; top: 20%; left: 60%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.14</button>
</div>
<div style="position: absolute; top: 20%; left: 70%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.15</button>
</div>
<div style="position: absolute; top: 20%; left: 80%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.16</button>
</div>
<div style="position: absolute; top: 30%; left: 10%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.17</button>
</div>
<div style="position: absolute; top: 30%; left: 20%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.18</button>
</div>
<div style="position: absolute; top: 30%; left: 30%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.19</button>
</div>
<div style="position: absolute; top: 30%; left: 40%; width: 0; height: 0;">
    <button class="modal-button" style="width: 80px; height: 40px; transform: rotate(25deg);">8.20</button>
</div>

    </div>
</div>


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
     // Add event listeners for buttons to open modals
     document.getElementById('modalBtn5').onclick = function() { openModal('myModal5'); }
    document.getElementById('modalBtn6').onclick = function() { openModal('myModal6'); }
    document.getElementById('modalBtn7').onclick = function() { openModal('myModal7'); }
    document.getElementById('modalBtn8').onclick = function() { openModal('myModal8'); }


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

