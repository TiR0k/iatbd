let endDate;
const check = (open, element) => {
    endDate = element.getElementsByClassName("end_date")[0]
}

const changeStart = (startDate) => {
    if (startDate.value !== "") {
        endDate.setAttribute("min", startDate.value);
    } else {
        endDate.setAttribute("min", startDate.min);
    }
}
