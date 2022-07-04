import "flowbite";
import $ from "jquery";

const feather = require("feather-icons");
feather.icons.x;
feather.icons.x.toSvg();

feather.icons.x.toSvg({ class: "foo bar", "stroke-width": 1, color: "red" });
