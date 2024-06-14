// console.log("Works")

let n_visibleIcon = document.getElementsByClassName("not_vis");
Array.from(n_visibleIcon).forEach(function (icons) {
  icons.style.display = "none";
});

function onSubmitcheckPasswords() {
  let password = document.getElementById("pwd");
  let confirmPassword = document.getElementById("c_pwd");
  console.log(password);
  console.log(confirmPassword);
  if (password === confirmPassword) {
    return true;
  } else {
    window.alert("Passwords do not match. Please try again.");
    return false;
  }
}

//  to check if password matches
function checkPasswords() {
  let password = document.getElementById("pwd").value;
  let confirmPassword = document.getElementById("c_pwd").value;
  let pwdError = document.getElementById("inputError");

  if (password !== confirmPassword) {
    pwdError.textContent = "Password do not match";
    document
      .getElementById("c_pwd")
      .setCustomValidity("Passwords do not match");
    return false;
  } else {
    pwdError.textContent = " ";
    document.getElementById("c_pwd").setCustomValidity("");
    return true;
  }
}

function togglePwdVisibility() {
  let visibility = document.getElementById("pwd");

  let visibleIcon = document.getElementById("vis");
  let n_visibleIcon = document.getElementById("not_vis");
  // n_visibleIcon.style.display = "none";
  if (visibility.type === "password") {
    visibility.type = "text";
    visibleIcon.style.display = "none";
    n_visibleIcon.style.display = "flex";
  } else {
    visibility.type = "password";
    visibleIcon.style.display = "flex";
    n_visibleIcon.style.display = "none";
  }
}

function toggle_C_PwdVisibility() {
  let visibility = document.getElementById("c_pwd");

  let visibleIcon = document.getElementById("vis_c");
  let n_visibleIcon = document.getElementById("not_vis_c");
  // n_visibleIcon.style.display = "none";
  if (visibility.type === "password") {
    visibility.type = "text";
    visibleIcon.style.display = "none";
    n_visibleIcon.style.display = "flex";
  } else {
    visibility.type = "password";
    visibleIcon.style.display = "flex";
    n_visibleIcon.style.display = "none";
  }
}

function login(e) {
  e.preventDefault();

  const email = document.getElementById("email").value;
  const regex = /^[a-zA-Z0-9._%+-]+@(aastustudent|aastu)\.edu\.et$/;

  if (!regex.test(email)) {
    const error = document.querySelector(".error");
    console.log(error);
    error.innerText = "Please use your AASTU email";
    return;
  }

  let users = localStorage.getItem("aastu_users");
  users = JSON.parse(users);

  const user = users.find((user) => user.email === email);
  if (!user) {
    const error = document.querySelector(".error");
    error.innerText = "User not found";
    return;
  }

  if (user.password !== document.getElementById("pwd").value) {
    const error = document.querySelector(".error");
    error.innerText = "Incorrect password";
    return;
  }

  const obj = {
    isLoggedIn: true,
    isAdmin: user.isAdmin,
  };
  localStorage.setItem("aastu", JSON.stringify(obj));
  if (user.isAdmin) {
    window.history.pushState({}, "", "/AdminPage/admin.html");
    window.location.replace("/AdminPage/admin.html");
  } else {
    window.history.pushState({}, "", "/homepage/homepage.html");
    window.location.replace("/homepage/homepage.html");
  }
}

function register(e) {
  e.preventDefault();
  const email = document.getElementById("email").value;
  const regex = /^[a-zA-Z0-9._%+-]+@aastu\.edu\.et$/;

  if (!regex.test(email)) {
    const error = document.querySelector(".error");
    console.log(error);
    error.innerText = "Please use your AASTU email";
    return;
  }

  const users = localStorage.getItem("aastu_users");

  const user = {
    name: document.getElementById("name").value,
    occupation: document.getElementById("occupation").value,
    email: email,
    isAdmin: email === "goytom@aastu.edu.et",
    password: document.getElementById("pwd").value,
  };

  if (!users) {
    localStorage.setItem("aastu_users", JSON.stringify([user]));
  } else {
    const parsedUsers = JSON.parse(users);
    parsedUsers.push(user);
    localStorage.setItem("aastu_users", JSON.stringify(parsedUsers));
  }

  window.history.pushState({}, "", "/auth_page/login.html");
  window.location.replace("/auth_page/login.html");
}
