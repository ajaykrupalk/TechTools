<template>
  <section class="h-screen">
    <form @submit.prevent="submitForm">
      <div class="pt-40">
        <div class="relative m-auto w-96">
          <input
            v-model="form.url"
            type="url"
            placeholder="https://example.com"
            class="
              w-full
              bg-gray-100
              p-1
              border-2 border-gray-200
              rounded
              text-sm
              placeholder:text-xs placeholder:text-gray-400
              outline-2 outline-blue-500/50
            "
          />
          <button
            type="submit"
            class="
              absolute
              bg-blue-100
              top-0
              right-0
              rounded-tr rounded-br
              p-1.5
              text-sm
              font-bold
              text-blue-500
              hover:bg-blue-200
            "
          >
            <DocumentArrowDownIcon class="h-5 w-5" />
          </button>
        </div>
      </div>
    </form>
    <div class="m-auto w-96 mt-40 pb-5">
      <h1 class="font-bold tracking-wider text-sm">Added Links</h1>
      <div v-for="link in data" :key="link">
        <form @submit.prevent="deleteDetails(link.id)">
          <div class="relative mt-2 w-96">
            <a :href="link.url" target="_blank">
              <input
                :value="link.url"
                class="
                  w-full
                  bg-gray-100
                  p-1
                  border-2 border-gray-200
                  rounded
                  text-sm
                  placeholder:text-xs placeholder:text-gray-400
                  outline-none
                "
                readonly
              />
            </a>
            <button
              type="submit"
              class="
                absolute
                bg-red-100
                top-0
                right-0
                rounded-tr rounded-br
                p-1.5
                text-sm
                font-bold
                text-red-500
                hover:bg-red-200
              "
            >
              <ArchiveBoxXMarkIcon class="h-5 w-5" />
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import {
  DocumentArrowDownIcon,
  ArchiveBoxXMarkIcon,
} from "@heroicons/vue/24/solid";
import axios from "axios";

import { Tool } from "../../services/";

export default {
  name: "addForm",
  components: {
    DocumentArrowDownIcon,
    ArchiveBoxXMarkIcon,
  },
  data() {
    return {
      form: {
        url: "",
        image:
          "https://img.freepik.com/premium-vector/illustration-space_29937-1093.jpg?w=2000",
        description: "None",
      },
      data: [],
    };
  },
  created() {
    this.getDetails();
  },
  methods: {
    async submitForm() {
      if (this.form.url !== "") {
        try {
          const response = await axios.post(
            "https://api.peekalink.io/",
            { link: this.form.url },
            { headers: { "X-API-Key": "be203588-dea6-4858-b984-de9187f4bd37" } }
          );
          console.log("Request Successful");
          if (response.data.image) {
            this.form.image = response.data.image.url;
          }
          if (response.data.description) {
            this.form.description = response.data.description;
          }
          this.storeDetails(this.form);
        } catch (error) {
          if (error.response) {
            console.log(error.status);
          } else {
            console.log(error.message);
          }
        }

        this.form.url = "";
        this.form.description = "";
      } else {
        console.log("Please enter a valid URL");
      }
    },
    storeDetails() {
      Tool.store(this.form)
        .then((response) => {
          console.log(response);
          if (response.status === 201) {
            console.log("Data Stored");
            this.getDetails();
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    getDetails() {
      Tool.get()
        .then((response) => {
          console.log(response);
          if (response.status === 200) {
            console.log("Data Retrieved");
            this.data = response.data;
            this.data = this.data.reverse();
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    deleteDetails(val) {
      Tool.delete(val)
        .then((response) => {
          console.log('delete-details',response);
          if (response.status === 200) {
            console.log("Data Deleted");
            this.getDetails();
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
};
</script>