function passwordValid() {

    let [eight_characters_object, one_lower_case_object, one_upper_case_object, one_number_object, one_special_sing_object] = document.querySelectorAll(".correct, .wrong");
    console.log(eight_characters_object);
    console.log(one_upper_case_object);
    console.log(one_number_object);
    console.log(one_special_sing_object);

    let password = get_given_password().value;

    const map = new Map();
    map.set(eight_characters_object, new RegExp('.{8,}'));
    map.set(one_lower_case_object, new RegExp('(?=.*[a-z])'));
    map.set(one_upper_case_object, new RegExp('(?=.*[A-Z])'));
    map.set(one_number_object, new RegExp('(?=.*[0-9])'));
    map.set(one_special_sing_object, new RegExp('(?=.*[@#$%^&+=])'));


    let continue_count = 0;
    for (const [key, value] of map.entries()) {
        console.log(key, value);
        if (value.test(password)) {
            key.classList.remove("wrong");
            key.classList.add("correct");
            continue_count += 1;
        } else {
            key.classList.remove("correct");
            key.classList.add("wrong");
        }
    }
    if (continue_count !== 5) {
        let opacity_none = document.querySelectorAll(".opacity_full");
        console.log(opacity_none);
        if (opacity_none[0]) {
            opacity_none[0].classList.remove("opacity_full");
            opacity_none[0].classList.add("opacity_none");
        }
    } else {
        let opacity_full = document.querySelectorAll(".opacity_none");
        console.log(opacity_full);
        if (opacity_full[0]) {
            opacity_full[0].classList.remove("opacity_none");
            opacity_full[0].classList.add("opacity_full");
        }
    }

}

function get_given_password() {
    return document.querySelector(".input");
}
