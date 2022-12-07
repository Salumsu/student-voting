function checkLimit(name) {
  name = name.split(" ")[0];
  let boxes = document.getElementsByName(name);
  let limit = boxes[0].parentNode.dataset["limit"];
  let checkCount = 0;
  boxes.forEach((box) => {
    if (box.checked) {
      checkCount++;
    }
  });
  if (checkCount > limit) {
    alert(
      `You can only choose ${limit} candidate for the position of ${
        name.charAt(0).toUpperCase() + name.slice(1)
      }`
    );
    return false;
  }
}
