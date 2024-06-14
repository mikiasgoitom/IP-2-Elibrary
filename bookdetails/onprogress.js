document.addEventListener("DOMContentLoaded", () => {
    for (const el of document.querySelectorAll(".des")) {
        el.addEventListener("click", showDesc);
    }
})

function getSiblingElementByClass(e, siblingClass) {
    // Get the parent element of the target
    var parentElement = e.target.parentNode;
  
    // Get all the sibling elements of the parent element
    var siblings = Array.from(parentElement.children);
  
    // Find the sibling element with the specified class
    var siblingElement = siblings.find(function(element) {
      return element.classList.contains(siblingClass);
    });
  
    return siblingElement;
  }

function showDesc(e) {
   const desc = getSiblingElementByClass(e, "discription");
   if (desc.classList.contains("hidden")) {
    desc.classList.remove("hidden");
   } else {
    desc.classList.add("hidden");

   }
}