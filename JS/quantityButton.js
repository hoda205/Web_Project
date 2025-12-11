const decrementBtn = document.getElementById("decrement-btn");
const incrementBtn = document.getElementById("increment-btn");
const numberInput = document.getElementById("number-input");

decrementBtn.addEventListener("click", () => {
  numberInput.stepDown(1);
});

incrementBtn.addEventListener("click", () => {
  numberInput.stepUp(1);
});