const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    if(window.innerWidth < 768) {
        sidebar.classList.add('hide');
    } else if(window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})




document.addEventListener("DOMContentLoaded", function () {
    var viewButtons = document.querySelectorAll(".viewSelection");
    viewButtons.forEach(viewButton => {
        viewButton.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default link behavior

            // Highlight the clicked viewButton as before
            document.querySelector("#darea").textContent = this.getAttribute('data-darea');
            document.querySelector("#graveno").textContent = this.getAttribute('data-graveno');
            document.querySelector("#name").textContent = this.getAttribute('data-name');
            document.querySelector("#death").textContent = this.getAttribute('data-death');
            // document.querySelector("#img-link").src = this.getAttribute('data-dareaImg');

            // Show the modal manually
            var modal = new bootstrap.Modal(document.getElementById('displayPerson'));
            modal.show();

                    // Get a reference to the "Close" button by its ID
            var closeModalBtn = document.getElementById("closeModalBtn");

            // Add a click event listener to the button
            closeModalBtn.addEventListener("click", function() {
                // Perform the redirection to index2-view.php
                window.location.href = "index2-view.php";
            });    
        });
    });
});



window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})