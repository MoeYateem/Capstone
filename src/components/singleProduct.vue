<template>
  <!-- Product Image And details -->
  <div
    class="bg-secondary lg:flex-row justify-center items-center w-full h-auto overflow-auto flex-col pt-6 lg:pt-0"
  >
    <div
      class="flex flex-col items-center justify-center md:flex-row h-fit relative pt-6 sm:pt-0"
    >
      <!-- Image gallery -->
      <div
        class="px-6 sm:w-1/3 w-full flex items-center justify-center relative"
      >
        <div class="w-full h-[600px] max-w-full">
          <img
            :src='"http://localhost/Tunezz/Tunezz/src/assets/" +product.image'
            
            alt="Product Image"
            class="w-full h-full object-cover rounded-md"
          />
        </div>
      </div>

      <!-- Product info -->
      <div
        class="w-full md:w-1/2 mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16"
      >
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1
            class="text-2xl font-bold tracking-tight text-primary sm:text-3xl"
          >
            {{ product.name }}
          </h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
          <h2 class="sr-only">Product information</h2>
          <p class="text-3xl tracking-tight text-primary">
            {{ product.price }}
          </p>

          <!-- Reviews -->

          <form class="mt-10">
            <!-- Colors -->
            <div>
              <h3 class="text-sm font-medium text-primary">Color</h3>

              <RadioGroup v-model="selectedColor" class="mt-4">
                <RadioGroupLabel class="sr-only"
                  >Choose a color</RadioGroupLabel
                >
                <div class="flex items-center space-x-3">
                  <RadioGroupOption
                    as="template"
                    v-for="color in product.colors"
                    :key="color.name"
                    :value="color"
                    v-slot="{ active, checked }"
                  >
                    <div
                      :class="[
                        color.selectedClass,
                        active && checked ? 'ring ring-offset-1' : '',
                        !active && checked ? 'ring-2' : '',
                        'relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none',
                      ]"
                    >
                      <RadioGroupLabel as="span" class="sr-only">
                        {{ color.name }}
                      </RadioGroupLabel>
                      <span
                        aria-hidden="true"
                        :class="[
                          color.class,
                          'h-8 w-8 rounded-full border border-black border-opacity-10',
                        ]"
                      />
                    </div>
                  </RadioGroupOption>
                </div>
              </RadioGroup>
            </div>

            <button
              type="submit"
              class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-primary px-8 py-3 text-base font-medium text-white hover:bg-primary/80 active:translate-y-0.5 transition-all duration-200 ease-in-out"
            >
              Add to bag
            </button>
          </form>
        </div>

        <div
          class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6"
        >
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">
              <p class="text-base text-white">{{ product.description }}</p>
            </div>
          </div>

          <div class="mt-10">
            <h3 class="text-sm font-medium text-primary">Highlights</h3>

            <div class="mt-4">
              <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                <li
                  v-for="highlight in product.highlights"
                  :key="highlight"
                  class="text-white"
                >
                  <span class="text-white">{{ highlight }}</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="mt-10">
            <h2 class="text-sm font-medium text-primary">Details</h2>

            <div class="mt-4 space-y-6">
              <p class="text-sm text-white">{{ product.details }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Review section -->
  <!-- <div
    class="w-full mx-auto px-4 py-8 flex flex-col lg:flex-row justify-evenly items-center"
  >
    <div class="mb-8 lg:w-2/3 p-10 w-full">
      <h2 class="text-2xl font-bold mb-4 text-primary">Reviews</h2>
      <ul role="list" class="divide-y divide-gray-100">
        <li
          v-for="review in reviews.slice(0, 10)"
          :key="review.id"
          class="py-4"
        >
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-primary">{{ review.email }}</h3>
            <p class="text-sm text-white">{{ review.date }}</p>
          </div>
          <p class="text-white mt-2">{{ review.content }}</p>
          <div class="flex mt-2">
            <StarRating :rating="review.rating" />
          </div>
        </li>
      </ul>
    </div>
    <div class="lg:w-1/3 p-10 w-full">
      <h2 class="text-2xl font-bold mb-4 text-primary">Write a Review</h2>
      <form @submit.prevent="submitReview">
        <div class="mb-4">
          <label for="email" class="text-primary">Your Email</label>
          <input
            type="email"
            id="email"
            v-model="newReview.email"
            class="mt-2 block w-full rounded-md bg-gray-100 bg-opacity-70 border-transparent focus:border-primary focus:bg-white focus:ring-0 px-4 py-3 text-lg"
          />
        </div>
        <div class="mb-4">
          <label class="text-primary">Rating</label>
          <StarRating v-model="newReview.rating" />
        </div>
        <div class="mb-4">
          <label for="content" class="text-primary">Review</label>
          <textarea
            id="content"
            v-model="newReview.content"
            rows="4"
            class="mt-2 block w-full rounded-md bg-gray-100 bg-opacity-70 border-transparent focus:border-primary focus:bg-white focus:ring-0 px-4 py-3 text-lg"
          ></textarea>
        </div>
        <button
          type="submit"
          class="px-4 py-2 bg-primary text-white font-medium rounded"
        >
          Submit Review
        </button>
      </form>
    </div>
  </div> -->
</template>

<!--SCRIPT-->
<script setup>
import { ref, computed, onMounted , reactive } from 'vue';
import { useRoute } from 'vue-router';

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from "@headlessui/vue";
// StarRating component
// const StarRating = {
//   props: ["rating"],
//   methods: {
//     setRating(rating) {
//       this.$emit("update:rating", rating);
//     },
//   },
//   template: `
//     <div>
//       <span
//         v-for="star in 5"
//         :key="star"
//         @click="setRating(star)"
//         :class="[
//           'text-yellow-400',
//           'hover:text-yellow-500',
//           'cursor-pointer',
//           star <= rating ? 'text-yellow-500' : 'text-gray-300'
//         ]"
//       >
//         &#9733;
//       </span>
//     </div>
//   `,
// };

// const reviews = [
//   {
//     id: 1,
//     email: "john@example.com",
//     date: "2023-05-10",
//     content: "Great product!",
//     rating: 5,
//   },
//   {
//     id: 1,
//     email: "john@example.com",
//     date: "2023-05-10",
//     content: "Great product!",
//     rating: 5,
//   },
//   {
//     id: 1,
//     email: "john@example.com",
//     date: "2023-05-10",
//     content: "Great product!",
//     rating: 5,
//   },
//   {
//     id: 2,
//     email: "jane@example.com",
//     date: "2023-05-09",
//     content: "Love it!",
//     rating: 4,
//   },
//   // Add more review objects here
// ];

// const newReview = ref({
//   author: "",
//   content: "",
// });

// const submitReview = () => {
//   if (newReview.value.author && newReview.value.content) {
//     const review = {
//       id: reviews.value.length + 1,
//       author: newReview.value.author,
//       date: new Date().toLocaleDateString("en-US", {
//         month: "long",
//         day: "numeric",
//         year: "numeric",
//       }),
//       content: newReview.value.content,
//     };
//     reviews.value.unshift(review);
//     newReview.value.author = "";
//     newReview.value.content = "";
//   }
// };
const product = reactive({
  name: '',
  price: '',
  image: '',
  description: '',
  details: ''
});
const fetchProductData = async () => {
  const route = useRoute();
  const itemName = route.query.item_name;
  const response = await fetch(`http://localhost/Tunezz/Tunezz/APIs/appfunctions/singleproduct.php?item_name=${itemName}`);
  const data = await response.json();
  console.log("Fetched data:", data);

  if (data && data.length > 0) {
    const fetchedProduct = data[0];
    // Update the 'product' object with the fetched data
    product.name = fetchedProduct.Name;
    product.price = fetchedProduct.Price;
    product.image = fetchedProduct.Pic; // Updated property name
    product.description = fetchedProduct.Type; // Updated property name
    product.details = fetchedProduct.details;
    // You might need to update colors, sizes, highlights, etc., depending on the data structure in your API response
  }
};
// const selectedColor = ref(product.colors[0]);
// const selectedSize = ref(product.sizes[2]);
onMounted(fetchProductData);
</script>