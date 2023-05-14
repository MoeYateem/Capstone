<script setup>
import { ref } from "vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import axios from "axios";
import { Switch, SwitchGroup, SwitchLabel } from "@headlessui/vue";
const newcontact = ref({ email: "", phone_number: 0,fname: "",lname: "",company: "",message: "", });
const submitContact= async () => {
  const url = 'http://localhost/Tunezz/Tunezz/APIs/appfunctions/contact.php';
  
  // const email = userEmail.value;
  const fname= newcontact.value.fname;
  const lname= newcontact.value.lname;
  const company= newcontact.value.company;
  const phone_number= newcontact.value.phone_number;
  const message= newcontact.value.message;
  const email= newcontact.value.email;
  const data = {
    // cartadd: true,
    submit:true,
    email: email,
    fname:fname,
    lname:lname,
    company:company,
    phone_number:phone_number,
    message:message
  };
  console.log("Data to be sent:", data);

  try {
    const response = await axios.post(url, new URLSearchParams(data));
    console.log("Response:", response.data);
  } catch (error) {
    console.error('Error:', error);
  }
};
const agreed = ref(false);
</script>

<template>
  <div class="isolate bg-secondary px-6 py-24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
      <h2 class="text-3xl font-bold tracking-tight text-primary sm:text-4xl">
        Contact sales
      </h2>
      <p class="mt-2 text-lg leading-8 text-tertiary">
        Aute magna irure deserunt veniam aliqua magna enim voluptate.
      </p>
    </div>
    <form @submit.prevent="submitContact">
      <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
        <div>
          <label
            for="first-name"
            

            class="block text-sm font-semibold leading-6 text-primary"
            
            >First name</label
          >
          <div class="mt-2.5">
            <input
              type="text"
              v-model="newcontact.fname"
              name="first-name"
              id="first-name"
              autocomplete="given-name"
              class="block w-full bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary rounded-md border-0 px-3.5 py-2 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            />
          </div>
        </div>
        <div>
          <label
            for="last-name"
            class="block text-sm font-semibold leading-6 text-primary"
            >Last name</label
          >
          <div class="mt-2.5">
            <input
              type="text"
              name="last-name"
              v-model="newcontact.lname"
              id="last-name"
              autocomplete="family-name"
              class="block w-full bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary rounded-md border-0 px-3.5 py-2 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            />
          </div>
        </div>
        <div class="sm:col-span-2">
          <label
            for="company"
            class="block text-sm font-semibold leading-6 text-primary"
            >Company</label
          >
          <div class="mt-2.5">
            <input
              type="text"
              name="company"
              v-model="newcontact.company"
              id="company"
              autocomplete="organization"
              class="block bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary w-full rounded-md border-0 px-3.5 py-2 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            />
          </div>
        </div>
        <div class="sm:col-span-2">
          <label
            for="email"
            class="block text-sm font-semibold leading-6 text-primary"
            >Email</label
          >
          <div class="mt-2.5">
            <input
              type="email"
              name="email"
              id="email"
              v-model="newcontact.email"
              autocomplete="email"
              class="block bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary w-full rounded-md border-0 px-3.5 py-2 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            />
          </div>
        </div>
        <div class="sm:col-span-2">
          <label
            for="phone-number"
            class="block text-sm font-semibold leading-6 text-primary"
            >Phone number</label
          >
          <div class="relative mt-2.5">
            <div class="absolute inset-y-0 left-0 flex items-center">
              <label for="country" class="sr-only">Country</label>
              <select
                id="country"
                v-model="newcontact.country"
                name="country"
                class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-4 pr-9 text-gray-400 focus:ring-1 sm:text-sm"
              >
                <option>US</option>
                <option>CA</option>
                <option>EU</option>
              </select>
              <ChevronDownIcon
                class="pointer-events-none absolute right-3 top-0 h-full w-5 text-gray-400"
                aria-hidden="true"
              />
            </div>
            <input
              type="tel"
              name="phone-number"
              id="phone-number"
              v-model="newcontact.phone_number"
              autocomplete="tel"
              class="block w-full bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary rounded-md border-0 px-3.5 py-2 pl-20 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            />
          </div>
        </div>
        <div class="sm:col-span-2">
          <label
            for="message"
            class="block text-sm font-semibold leading-6 text-primary"
            >Message</label
          >
          <div class="mt-2.5">
            <textarea
              name="message"
              id="message"
              v-model="newcontact.message"
              rows="4"
              class="block w-full bg-gray-100 bg-opacity-70 focus:bg-white focus:ring-primary rounded-md border-0 px-3.5 py-2 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 sm:text-sm sm:leading-6"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="mt-10">
        <button
          type="submit"
          class="block w-full rounded-md bg-primary px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-primary/80 active:translate-y-0.5 transition-all duration-200 ease-in-out"
        >
          Let's talk
        </button>
      </div>
    </form>
  </div>
</template>
