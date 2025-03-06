<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header align-items-start">
            <ul class="nav justify-content-center py-4 ">
              <li class="nav-item active" step="1">
                <a class="nav-link px-0" aria-current="page" href="#">Step 1</a>
                <h6>Product Selection</h6>
              </li>
              <li class="nav-item " step="2">
                <a class="nav-link px-0" href="#">Step 2</a>
                <h6>Contact Information</h6>
              </li>
              <li class="nav-item " step="3">
                <a class="nav-link px-0" href="#">Step 3</a>
                <h6>Review Information</h6>
              </li>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-md-5 p-1">
            <x-quote_step1 />
          <div>

          </div>
        </div>
        <div class="modal-footer py-4">
            <button type="button" class="btn btn-thin-light" data-bs-dismiss="modal" id="prvBtn">Continue Browsing</button>
            <button type="button" class="btn btn-primary" id="nxtBtn">Next Step</button>
        </div>
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .nav {
            flex-direction: column;
            align-items: center;
        }
        .nav-item {
            width: 100%; /* Full width to expand the clickable area */
        }
    }
</style>
<script>
function loadStepContent(stepCount) {
    const xhr = new XMLHttpRequest()
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            document.querySelector('.modal-body').innerHTML = xhr.responseText

            if(stepCount == 2 || stepCount == 3){
                formHeadRename()
            }

        } else {
            console.error('The request failed!');
        }
    }
    xhr.onerror = function() {
        console.error('The request failed!')
    }

    const path = 'quote-step'+stepCount
    xhr.open('GET', path, true)
    xhr.send()

    // Toggle active class on the <li> element
    toggleActiveClass(stepCount)

    buttonTextAlter(stepCount)


    if(stepCount == 2 || stepCount == 3){
        formHeadRename()
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const stepItems = document.querySelectorAll('.modal-header .nav-item')

    stepItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var step = this.getAttribute('step')
            if (step) {
                loadStepContent(step)
            }
        })
    })
})

function toggleActiveClass(stepCount) {
    // Remove 'active' class from all <li> elements
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.classList.remove('active');
    });

    // Add 'active' class to the <li> element with the corresponding 'step' attribute
    const activeNavItem = document.querySelector(`.nav-item[step="${stepCount}"]`);
    if (activeNavItem) {
        activeNavItem.classList.add('active');
    }
}
function buttonTextAlter(stepCount){
    const prvbtn = document.querySelector('#prvBtn')
    const nxtBtn = document.querySelector('#nxtBtn')

    if (stepCount == 1) {
        prvbtn.innerHTML = 'Continue Browsing'
        nxtBtn.innerHTML = 'Next Step'
    } else if (stepCount == 2) {   
        prvbtn.innerHTML = 'Previous Step'
        nxtBtn.innerHTML = 'Review Information'
    } else if (stepCount == 3){
        prvbtn.innerHTML = 'Edit Information'
        nxtBtn.innerHTML = 'Submit'
    } 
    else {
        prvbtn.innerHTML = 'Continue Browsing'
        nxtBtn.innerHTML = 'Next Step'
    }
}
function formHeadRename(){
    const contactUsForm = document.querySelector('#contact-us-form')
    const requestQuoteForm = document.querySelector('#request-quote-form')
    console.log('here')
    console.log(contactUsForm)


    //remove the contactUsForm section
    if(contactUsForm){
        contactUsForm.remove()
        requestQuoteForm.style = "display:block"
    }

}
</script>
