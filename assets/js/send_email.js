const form = document.getElementById("contact-form");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const firstName = form.elements.first_name.value;
  const lastName = form.elements.last_name.value;
  const email = form.elements.email.value;
  const message = form.elements.message.value;

  const mailtoLink = `mailto:storemyup@gmail.com?subject=New%20Message%20from%20Your%20Website&body=Name:%20${firstName}%20${lastName}%0AEmail:%20${email}%0A%0AMessage:%0A${message}`;

  window.location.href = mailtoLink;
});
