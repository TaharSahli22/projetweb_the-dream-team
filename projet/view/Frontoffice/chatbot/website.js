///  Website CONTENT Images with textbox
function WebsiteImages() {
  const imgContent = document.querySelectorAll(".Content__imgs--box");

  let curI = 0;
  function showImg(index) {
    imgContent.forEach((imgbox, i) => {
      imgbox.classList.remove("active");
      if (index === i) imgbox.classList.add("active");
    });

    const textBox = imgContent[index].querySelectorAll(
      ".Content__imgs--textbox"
    );

    textBox.forEach((textbox, i) => {
      setTimeout(() => {
        textbox.classList.add("active");
        if (i === 1) {
          imgContent[index]
            .querySelector(".Content__imgs--img")
            .classList.add("shrink");
        }
        const textElement = textbox.querySelector("p");
        const textData = textbox.dataset.text;
        typeEffect(textElement, textData);
      }, i * 4000);
      //
      setTimeout(() => {
        textbox.classList.remove("active");
      }, (i + 1) * 4000);
    });
  }

  function typeEffect(TextBox, text) {
    TextBox.textContent = "";
    const words = text.split(" ");
    let curI = 0;
    //
    let typeInterval = setInterval(() => {
      TextBox.textContent += (curI === 0 ? "" : " ") + words[curI++];
      if (curI === words.length) {
        clearInterval(typeInterval);
      }
    }, 200);
  }
  function slideShow() {
    showImg(curI);
    setInterval(() => {
      curI = (curI + 1) % imgContent.length;
      showImg(curI);
    }, 8000);
  }

  document.addEventListener("DOMContentLoaded", slideShow);
}
WebsiteImages();

// SIGNIN To CHATBOT
function WebtoChat() {
  const popupForm = document.querySelector(".signin");

  // header sign-in
  const headerSigninBtn = document.querySelector(".Website__header--btn");

  headerSigninBtn.addEventListener("click", function () {
    popupForm.classList.toggle("signin-popup");
  });
  const contentSigninBtn = document.querySelector(
    ".Website__content--text-btn"
  );

  contentSigninBtn.addEventListener("click", function () {
    popupForm.classList.toggle("signin-popup");
  });

  //
  document.addEventListener("click", (event) => {
    if (
      !popupForm.contains(event.target) &&
      !contentSigninBtn.contains(event.target) &&
      !headerSigninBtn.contains(event.target)
    ) {
      popupForm.classList.add("signin-popup");
    }
  });
  //
  const disclaimerText = document.querySelector(".signin__disclaimer-text");
  const loginText = document.querySelector(".signin__popup-form");
  popupForm.addEventListener("submit", function (e) {
    e.preventDefault();
    disclaimerText.style.display = "block";
    loginText.style.display = "none";
  });
}
WebtoChat();
