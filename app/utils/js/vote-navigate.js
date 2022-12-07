const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");
const submitButton = document.getElementById("submit");
const pages = document.querySelectorAll(".position");

let viewId = 0;

function updateView() {
  for (let i = 0; i < pages.length; i++) {
    if (i < viewId) {
      pages[i].classList.add("done");
      pages[i].classList.remove("current");
      pages[i].classList.remove("next");
    } else if (i == viewId) {
      pages[i].classList.remove("done");
      pages[i].classList.add("current");
      pages[i].classList.remove("next");
    } else {
      pages[i].classList.remove("done");
      pages[i].classList.remove("current");
      pages[i].classList.add("next");
    }
  }
}

updateView();

prevButton.addEventListener("click", () => {
  if (--viewId == 0) {
    if (prevButton.classList.contains("active")) {
      prevButton.classList.remove("active");
    }
    updateView();
    return;
  }

  submitButton.classList.remove("active");

  if (!nextButton.classList.contains("active")) {
    nextButton.classList.add("active");
  }
  updateView();
});

nextButton.addEventListener("click", () => {
  if (++viewId == pages.length - 1) {
    if (nextButton.classList.contains("active")) {
      nextButton.classList.remove("active");
    }
    submitButton.classList.add("active");
    updateView();
    return;
  }

  if (!prevButton.classList.contains("active")) {
    prevButton.classList.add("active");
  }

  updateView();
});
