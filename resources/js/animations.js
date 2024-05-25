import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

gsap.fromTo(".hero_slider_style2", {opacity: 0},{opacity: 1,  duration: 2});

gsap.fromTo(".enterprise_description_style2", 
    { opacity: 0, x: -500 },
    { 
        opacity: 1, 
        x: 0,  
        duration: 2,
        scrollTrigger: {
            trigger: ".enterprise_description_style2",
            start: "top 80%", // Start the animation when the top of the element reaches the center of the viewport
            end: "top 50%", // End the animation when the center of the element reaches the center of the viewport
            scrub: false, // Smooth scrubbing
        }
    }
);

gsap.fromTo(".mission_value_vision_style2-content-nodes-node", 
    { opacity: 0, y: 50 },
    { 
        opacity: 1, 
        y: 0,
        duration: 1,
        stagger: 0.3,
        scrollTrigger: {
            trigger: ".mission_value_vision_style2-content-nodes",
            start: "top 80%", // Start when the top of the parent element reaches 80% of the viewport height
            end: "top 50%", // End when the top of the parent element reaches 50% of the viewport height
            scrub: false, // No smooth scrubbing
        }
    }
);

gsap.fromTo(".why_choose_us_style1-content-nodes-node", 
    { opacity: 0, x: 50 },
    { 
        opacity: 1, 
        x: 0,
        duration: 1.5,
        stagger: 0.5,
        scrollTrigger: {
            trigger: ".why_choose_us_style1-content-nodes",
            start: "top 80%", // Start when the top of the parent element reaches 80% of the viewport height
            end: "top 50%", // End when the top of the parent element reaches 50% of the viewport height
            scrub: false, // No smooth scrubbing
        }
    }
);