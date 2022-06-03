let checkbox_anders = document.getElementById("anders")
let checkbox_hond = document.getElementById("hond")
let checkbox_kat = document.getElementById("kat")
let checkbox_vogel = document.getElementById("vogel")
let list_of_pets = document.querySelectorAll("li.petGridCard")

for (let i = 0; i < list_of_pets.length; i++) {
    list_of_pets[i].style.display = ""
}

checkbox_anders.addEventListener("change", function(){
    if(checkbox_anders.checked) {
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Anders") {
                list_of_pets[i].style.display = ""
            }
        }
    }else{
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Anders") {
                list_of_pets[i].style.display = "none"
            }
        }
    }
})

checkbox_hond.addEventListener("change", function(){
    if(checkbox_hond.checked) {
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Hond") {
                list_of_pets[i].style.display = ""
            }
        }
    }else{
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Hond") {
                list_of_pets[i].style.display = "none"
            }
        }
    }
})

checkbox_kat.addEventListener("change", function(){
    if(checkbox_kat.checked) {
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Kat") {
                list_of_pets[i].style.display = ""
            }
        }
    }else{
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Kat") {
                list_of_pets[i].style.display = "none"
            }
        }
    }
})

checkbox_vogel.addEventListener("change", function(){
    if(checkbox_vogel.checked) {
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Vogel") {
                list_of_pets[i].style.display = ""
            }
        }
    }else{
        for (let i = 0; i < list_of_pets.length; i++) {
            if (list_of_pets[i].dataset.typeOfPet === "Vogel") {
                list_of_pets[i].style.display = "none"
            }
        }
    }
})


