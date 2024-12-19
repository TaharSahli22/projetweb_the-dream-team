/////////////////////////////////////

//

const Form = document.querySelector(".typing-area__form");
const input = document.querySelector(".typing-area__form--input");
// < ---- API ---- >
const API_KEY = "AIzaSyCX1Qu4_EhtJrUlF3rGe3Sv7ah3Fu-Mu1g";
const API_URL = `https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=${API_KEY}`;
const incomingText = document.querySelector(".chat__incoming--text");
//
const generateApiResponse = async (tempDiv2) => {
  const textElement = tempDiv2.querySelector(".chat__text");
  const response = await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      contents: [
        {
          role: "user",
          parts: [{ text: userval }],
        },
      ],
    }),
  });
  const data = await response.json();
  const apiResponse = data?.candidates[0].content.parts[0].text.replace(
    /\*\*(.*?)\*\*/g,
    "$1"
  );
  // textElement.innerHTML = apiResponse;
  // Else than Api
  tempDiv2.querySelector(".chat__loading").style.display = "none";

  typingEffect(apiResponse, textElement, tempDiv2);
};

let userval;
const chatList = document.querySelector(".chat-list");
// < ---- Outgoing  ---- >
function outGoing() {
  userval = input.value || userval;
  const html = `<div class="chat__content">
                    <img src="Svgs/user-img.jpg" alt="user" class="chat__img" />
                    <p class="chat__outgoing--text"></p>
                </div>`;

  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = html;
  tempDiv.querySelector(".chat__outgoing--text").innerHTML = userval;

  // Scroller
  chatList.scrollTo(0, chatList.scrollHeight);
  chatList.appendChild(tempDiv);
  loadingBars();
  // Loading bars
  document.querySelector(".header").classList.add("hide-header");
}

// < ---- Event Listener ---- >
Form.addEventListener("submit", function (e) {
  e.preventDefault();
  outGoing();
});

//  --------------------------------- Effetcs

//  <---- Loading bars ---->
function loadingBars() {
  const loadinghtml = ` <div class="chat__content">
            <img src="Svgs/Gemini-img.png" alt="chatbot" class="chat__img" />
            <p class="chat__text"></p>
           
            <div class="chat__loading">
            <div class="chat__loading--bars"></div>
            <div class="chat__loading--bars"></div>
            <div class="chat__loading--bars"></div>
            </div>
            </div>
            <img onclick="copyText(this)" src="Svgs/Copy.svg" class="icon icon-copy ">

            `;

  const tempDiv2 = document.createElement("div");
  tempDiv2.innerHTML = loadinghtml;

  // Scroller
  chatList.scrollTo(0, chatList.scrollHeight);
  // Adding the API and API text
  generateApiResponse(tempDiv2);
  chatList.appendChild(tempDiv2);

  tempDiv2.querySelector(".icon-copy").classList.add("hide");
}

// <---- Text Animation ---- >

function typingEffect(apiResponse, textElement, tempDiv2) {
  const words = apiResponse.split(" ");
  let curI = 0;
  //Function
  const typingInterval = setInterval(() => {
    console.log(words[curI]);
    textElement.innerHTML += (curI === 0 ? "" : " ") + words[curI++];
    // IF
    if (curI === words.length) {
      clearInterval(typingInterval);
      tempDiv2.querySelector(".icon-copy").classList.remove("hide");

      localStorage.setItem("savedChat", chatList.innerHTML);
    }
    // Scroller
    chatList.scrollTo(0, chatList.scrollHeight);
  }, 75);
}

// < ---- Copy Text ---- >
function copyText(copyIcon) {
  const msgText = copyIcon.parentElement.querySelector(".chat__text").innerText;
  navigator.clipboard.writeText(msgText);
  copyIcon.src = "Svgs/Copied.svg";
}

// < ---- Changing The Theme ---- >

const theme = document.querySelector("#theme");
theme.addEventListener("click", function () {
  const curTheme = document.body.classList.toggle("light-mode");
  localStorage.setItem("theme", curTheme ? "white-theme" : "blue-theme");
});

//  < ---- Setting theme and chat for page reload ---- >
function loadStorage() {
  const storedTheme = localStorage.getItem("theme");
  if (storedTheme === "white-theme") {
    document.body.classList.add("light-mode");
  } else {
    document.body.classList.remove("light-mode");
  }

  const savedChat = localStorage.getItem("savedChat");
  chatList.innerHTML = savedChat || "";
  //
  document.querySelector(".header").classList.toggle("hide-header", savedChat);
  // Scroller
  chatList.scrollTo(0, chatList.scrollHeight);
}
loadStorage();

//  < ---- Deleting the chats ---- >
const deleteChat = document.querySelector("#delete");
deleteChat.addEventListener("click", function () {
  localStorage.removeItem("savedChat");
  loadStorage();
});

// < ---- Setting the Suggestions ---- >
const Suggestions = document.querySelectorAll(".header__suggestion");
Suggestions.forEach((sug) =>
  sug.addEventListener("click", function () {
    userval = sug.querySelector(".suggestion__text").innerText;
    outGoing();
  })
);
