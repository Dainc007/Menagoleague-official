

const fourthBlockNav = document.querySelector(".content-block__nav.fourth");

fourthBlockNav.childNodes.forEach( navItem => {

    const fourthBlockWrapper = document.querySelector(".content-block__fourth-wrapper")

    navItem.addEventListener("click", (e) => {

        let moveValue;
    
        switch(e.target.id) {

            case "first":
              moveValue = 0;
              break;
            case "second":
                moveValue = -100;
                break;
            case "third":
                moveValue = -200;
                break;
            default :
            moveValue = 0;
            break;
        }

        fourthBlockWrapper.style.transform = `translateX(${moveValue}%)`

        /* Remove earlier active options */
        if(document.querySelector(".flying-nav-central.fourth-section.active") ){
            const activeBlock = document.querySelector(".flying-nav-central.fourth-section.active");

            activeBlock.classList.remove("active");
        }

        e.target.classList.add("active");
        
    })
    
})

const secondBlockNav = document.querySelector(".content-block__nav.second");

secondBlockNav.childNodes.forEach( navItem => {

    const secondBlockWrapper = document.querySelector(".content-block__second-wrapper")

    navItem.addEventListener("click", (e) => {

        let moveValue;
    
        switch(e.target.id) {

            case "first":
              moveValue = 0;
              break;
            case "second":
                moveValue = -100;
                break;
            default :
            moveValue = 0;
            break;
        }

        secondBlockWrapper.style.transform = `translateX(${moveValue}%)`

        /* Remove earlier active options */
        if(document.querySelector(".flying-nav-central.second-section.active") ){
            const activeBlock = document.querySelector(".flying-nav-central.second-section.active");

            activeBlock.classList.remove("active");
        }

        e.target.classList.add("active");
        
    })
    
})