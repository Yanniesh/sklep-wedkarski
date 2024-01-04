
const initProductSlider = () => {
    const imageList = document.querySelector(".Product-wrapper .Product-list");
    const imageListLength = document.querySelectorAll(".Product-item").length;
    const slideButtons = document.querySelectorAll(".Product-wrapper .ProductSlide-button");
    const sliderScrollbar = document.querySelector(".ProductSliderContainer .ProductSlider-scrollbar");
    const scrollbarThumb = sliderScrollbar.querySelector(".product-scrollbar-thumb");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
    if (maxScrollLeft === 0) {
        sliderScrollbar.style.visibility = "hidden";
    }
    let direction = 1;
    function handleAnimation(){
        if(maxScrollLeft - imageList.scrollLeft < 5){
            direction = -1;
        }
        else if(imageList.scrollLeft < 4){
            direction = 1;
        }
        imageList.scrollLeft = imageList.scrollLeft + direction;

    }
    const interval = setInterval(handleAnimation, 100);


    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;
        const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft = scrollPosition;
        }


        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });


    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
    }

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        updateScrollThumbPosition();
    });
}

window.addEventListener("resize", initProductSlider);
window.addEventListener("load", initProductSlider);

