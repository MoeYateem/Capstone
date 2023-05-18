<template>
    <div class="container mx-auto py-8 w-[80%]">
      <h2 class="text-2xl font-semibold mb-4 text-primary border-b-2 pb-1">
        Admin Page
      </h2>
  
      <!-- Instrument List -->
      <div v-if="instruments.length > 0">
        <h3 class="text-xl font-semibold mb-2 text-primary border-b-2 pb-1 w-1/3">
          Instruments
        </h3>
        <ul>
          <li
            v-for="instrument in instruments"
            :key="instrument.id"
            class="border-b-2 pb-2"
          >
            <div class="flex justify-between items-center my-2">
              <div class="font-bold text-tertiary">{{ instrument.name }}</div>
              <div>
                <button
                  class="text-primary mr-2"
                  @click="editInstrument(instrument)"
                >
                  Edit
                </button>
                <button
                  class="text-red-600"
                  @click="removeInstrument(instrument.name)"
                >
                  Delete
                </button>
              </div>
            </div>
            <div class="text-tertiary/80">
              <p>Type: {{ instrument.type }}</p>
              <p>Price: {{ instrument.price }}</p>
              <p>Picture: {{ instrument.pic }}</p>
              <p>Details: {{ instrument.details }}</p>
            </div>
          </li>
        </ul>
      </div>
  
      <!-- Add/Edit Instrument Form -->
      <div class="mt-8">
        <h3 class="text-xl font-semibold mb-2 text-primary">
          {{ editing ? "Edit Instrument" : "Add Instrument" }}
        </h3>
        <form @submit.prevent="saveInstrument">
          <div class="mb-4">
            <label for="name" class="block mb-2 text-tertiary">Name</label>
            <input
              v-model="form.name"
              :name="editing ? 'edit-name' : 'add-name'"
              type="text"
              required
              class="border border-gray-300 rounded px-4 py-2 w-full"
            />
          </div>
          <div class="mb-4">
            <label for="type" class="block mb-2 text-tertiary">Type</label>
            <input
              v-model="form.type"
              id="type"
              type="text"
              required
              class="border border-gray-300 rounded px-4 py-2 w-full"
            />
          </div>
          <div class="mb-4">
            <label for="price" class="block mb-2 text-tertiary">Price</label>
            <input
              v-model="form.price"
              id="price"
              type="text"
              required
              class="border border-gray-300 rounded px-4 py-2 w-full"
            />
          </div>
          <div class="mb-4">
            <label for="pic" class="block mb-2 text-tertiary">Picture</label>
            <input
              v-model="form.pic"
              id="pic"
              type="text"
              required
              class="border border-gray-300 rounded px-4 py-2 w-full"
            />
          </div>
          <div class="mb-4">
            <label for="details" class="block mb-2 text-tertiary">Details</label>
            <textarea
              v-model="form.details"
              id="details"
              required
              class="border border-gray-300 rounded px-4 py-2 w-full"
            ></textarea>
          </div>
          <div>
            <button type="submit" class="bg-primary text-white rounded px-4 py-2">
              {{ editing ? "Save Changes" : "Add Instrument" }}
            </button>
            <button
              v-if="editing"
              type="button"
              class="text-red-600 ml-2"
              @click="cancelEdit"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
      <div class="mt-6 flex justify-center items-center w-full">
        <button
          type="button"
          @click="signOut"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
          Sign Out
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        instruments: [],
        form: {
          name: "",
          type: "",
          price: "",
          pic: "",
          details: "",
        },
        editing: false,
      };
    },
    created() {
      this.fetchInstruments();
  
      const role = localStorage.getItem("role");
  
      if (role !== "admin") {
        // Redirect or show an error message
        // For example, redirect to the homepage:
        window.location.href = "/";
      }
    },
    methods: {
      fetchInstruments() {
        axios
          .get(
            "http://localhost/Tunezz/Tunezz/APIs/appfunctions/get_instruments.php"
          )
          .then((response) => {
            this.instruments = response.data;
          })
          .catch((error) => {
            console.error("An error occurred while fetching instruments:", error);
          });
      },
  
      saveInstrument() {
        if (this.editing) {
          this.updateInstrument();
        } else {
          this.addInstrument();
        }
      },
      addInstrument() {
        console.log("Sending data:", this.form); // Log the data being sent
        axios
          .post(
            "http://localhost/Tunezz/Tunezz/APIs/appfunctions/add_instrument.php",
            this.form
          )
          .then(() => {
            this.clearForm();
            this.fetchInstruments();
            alert("Instrument added successfully!");
          })
          .catch((error) => {
            console.error("An error occurred while adding an instrument:", error);
            alert("An error occurred. Please try again.");
          });
      },
  
      updateInstrument() {
        axios
          .put(
            `http://localhost/Tunezz/Tunezz/APIs/appfunctions/update_instrument.php?name=${this.form.name}`,
            this.form
          )
          .then(() => {
            this.clearForm();
            this.fetchInstruments(); // Retrieve the updated instrument list
            alert("Instrument updated successfully!");
          })
          .catch((error) => {
            console.error(
              "An error occurred while updating an instrument:",
              error
            );
            alert("An error occurred. Please try again.");
          });
      },
  
      removeInstrument(name) {
        if (confirm("Are you sure you want to delete this instrument?")) {
          axios
            .delete(
              `http://localhost/Tunezz/Tunezz/APIs/appfunctions/delete_instrument.php?name=${name}`
            )
            .then(() => {
              this.fetchInstruments();
              alert("Instrument deleted successfully!");
            })
            .catch((error) => {
              console.error(
                "An error occurred while deleting an instrument:",
                error
              );
              alert("An error occurred. Please try again.");
            });
        }
      },
  
      editInstrument(instrument) {
        this.editing = true;
        this.form = { ...instrument };
      },
      cancelEdit() {
        this.editing = false;
        this.clearForm();
      },
      clearForm() {
        this.form = {
          name: "",
          type: "",
          price: "",
          pic: "",
          details: "",
        };
      },
    },
  };
  </script>