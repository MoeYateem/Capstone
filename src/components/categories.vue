<template>
  <div class="bg-secondary">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
        <h2 class="text-4xl font-bold text-primary text-center">Instruments</h2>

        <div
          class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0"
        >
        <div
            v-for="callout in callouts"
            :key="callout.name"
            class="group relative pt-10"
          >
            <router-link :to="'/productPage?selectedType=' + callout.name"
              ><div
                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64"
              >
                <img
                  :src="callout.imageSrc"
                  :alt="callout.imageAlt"
                  class="h-full w-full object-cover object-center"
                />
              </div>
              <h3
                class="mt-6 text-sm text-tertiary border-b border-primary pb-2"
              >
                <a :href="callout.href">
                  <span class="absolute inset-0" />
                  {{ callout.name }}
                </a>
              </h3>
              <p class="text-base font-semibold text-white">
                {{ callout.description }}
              </p>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<!-- <script>
import axios from "axios";
import shopCart from "./shopCart.vue";

export default {
  components: {
    shopCart,
  },
  data() {
    return {
      products: [],
      instrumentOptions: [
        "Guitars",
        "Piano",
        "Percussion",
        "Wind",
        "Violins & Family",
        "Bass",
      ],
      selectedType: "",
    };
  },
  computed: {
    filteredProducts() {
      if (this.selectedType === "") {
        return this.products;
      } else {
        return this.products.filter(
          (product) => product.type === this.selectedType
        );
      }
    },
  },
  methods: {
    fetchInstruments() {
      axios
        .get("http://localhost/Tunezz/Tunezz/APIs/appfunctions/get_instruments.php")
        .then((response) => {
          this.products = response.data.map((instrument, index) => {
            console.log("/assets/" + instrument.pic);
            return {
              id: index + 1,
              name: instrument.name,
              href: "#",
              imageSrc: "http://localhost/Tunezz/Tunezz/src/assets/" + instrument.pic
,
              imageAlt: `Front of ${instrument.name}`,
              price: `$${instrument.price}`,
              color: "", // You'll need to add color in the PHP API response or handle it differently
              type: instrument.type,
            };
          });
        })
        .catch((error) => {
          console.error("Error fetching instruments:", error);
        });
    },
  },
  mounted() {
    this.fetchInstruments();
  },
};
</script>  -->

<script setup>
import axios from "axios";
const callouts = [
  {
    name: "Guitars",
    description: "Dont' fret, we've got you covered!",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image2.jpg",
    imageAlt:
      "Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug.",
    href: "#",
  },
  {
    name: "Piano",
    description: "You could be the next Beethoven",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image1.jpg",
    imageAlt:
      "Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant.",
    href: "#",
  },
  {
    name: "Percussion",
    description: "Everything from snare drums to full kits",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image4.jpg",
    imageAlt: "Collection of four insulated travel bottles on wooden shelf.",
    href: "#",
  },
  {
    name: "Wind",
    description: "Our collection includes sopranissimo, soprano, alto, tenor and baritone",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image5.jpg",
    imageAlt: " Our collection includes sopranissimo, soprano, alto, tenor and baritone",
    href: "#",
  },
  {
    name: "Violins & Family",
    description: "Pick your string ache instrument",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image3.jpeg",
    imageAlt: "Collection of four insulated travel bottles on wooden shelf.",
    href: "#",
  },
  {
    name: "Bass",
    description: "Get that deep lowend",
    imageSrc:
      "http://localhost/Tunezz/Tunezz/src/assets/grid-image7.jpg",
    imageAlt: "Get that deep lowend",
    href: "#",
  },
];
</script> 