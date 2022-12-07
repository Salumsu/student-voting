const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
  for (let i = 0; i < positions.length; i++) {
    let position = positions[i];
    let boxes = document.getElementsByName(position.split(" ")[0]);
    let limit = boxes[0].parentNode.dataset["limit"];

    let checkCount = 0;
    boxes.forEach((box) => {
      if (box.checked) {
        checkCount++;
      }
    });

    if (checkCount < limit) {
      e.preventDefault();
      alert(`${position} requires ${limit} number of choice(s)`);
      break;
    }
  }
});
