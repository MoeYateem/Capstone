<template>
    <div
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
      @click="$emit('close')"
    >
      <div class="bg-white p-8 rounded-lg shadow-lg" @click.stop>
        <h2 class="text-xl font-semibold mb-4">Forgot Password</h2>
        <form v-if="!showSuccess" @submit.prevent="sendPasswordResetEmail(this.email),closeForm()">
          <div class="mb-4">
            <label for="email" class="block mb-2">Email</label>
            <input
              v-model="email"
              id="email"
              type="email"
              required
              class="border border-gray-300 p-2 rounded w-full"
            />
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              class="bg-primary text-white font-semibold py-2 px-4 rounded hover:bg-primary/80 active:translate-y-0.5 transition-all duration-200 ease-in-out"
            >
              Submit
            </button>
            <button
              v-if="!showSuccess"
              type="button"
              class="ml-2 bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded hover:bg-gray-200/80 active:translate-y-0.5 transition-all duration-200 ease-in-out"
              @click="closeForm"
            >
              Cancel
            </button>
          </div>
        </form>
        <div v-if="showSuccess" class="text-green-500 mt-4">
          Success! Password reset instructions sent to your email.
        </div>
        <div v-if="showFailure" class="text-red-500 mt-4">
          Email not found. Please try again.
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        email: "",
        // showSuccess: false,
        // showFailure: false,
      };
    },
    methods: {
      closeForm() {
        this.$emit("close");
      },
      async sendPasswordResetEmail(email) {
      try {
        const formData = new URLSearchParams();
        formData.append('email', email);

        const response = await axios.post('http://localhost/Tunezz/Tunezz/APIs/appfunctions/forgot_password.php', formData);
        console.log(response.data);

        // Display the response or perform any other actions
      } catch (error) {
        console.error(error);
        // Handle the error
      }
    },
  
      // emailExists(email) {
      //   // Dummy email check logic
      //   const dummyEmails = [
      //     "test@example.com",
      //     "user@example.com",
      //     "john@example.com",
      //   ];
      //   return dummyEmails.includes(email);
      // },
    },
  };
  </script>