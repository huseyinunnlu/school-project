<template>
  <form class="form-horizontal" @submit.prevent="update()">
    <div class="form-group row">
      <label for="favicon" class="col-sm-2 col-form-label">Favicon</label>
      <div class="col-sm-10 d-flex justify-content-center">

        <input
          type="file"
          class="form-control-file"
          id="favicon"
          @change="isUploadedFavicon"
        />
        <img
          :src="imagePreviews.faviconImage"
          class="rounded-circle"
          style="width:50px; height:50px; cursor:pointer;"
          v-if="imagePreviews.faviconImage"
          @click="imagePreviews.faviconImage = null,form.faviconImage = _Settings.faviconImage"
        />
        <img
          :src="form.faviconImage"
          class="rounded-circle"
          style="width:50px; height:50px;"
          v-else
        />
      </div>
      <small
        class="text-danger"
        v-if="errors.faviconImage"
        v-text="errors.faviconImage[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="title"
          placeholder="Title"
          v-model="form.title"
        />
      </div>
      <small
        class="text-danger"
        v-if="errors.title"
        v-text="errors.title[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label for="logo" class="col-sm-2 col-form-label">Logo</label>
      <div class="col-sm-10 d-flex">
        <input
          type="file"
          class="form-control-file"
          id="logo"
          @change="isUploadedLogo"
        />
        <img
          :src="form.logo"
          class="rounded-circle"
          style="width:50px; height:50px;"
          v-if="!imagePreviews.logo"
        />
        <img
          :src="imagePreviews.logo"
          class="rounded-circle"
          style="width:50px; height:50px; cursor:pointer;"
          @click="imagePreviews.logo = null,form.logo = _Settings.logo"          
          v-else
        />
        <small
          class="text-danger"
          v-if="errors.logo"
          v-text="errors.logo[0]"
        ></small>
      </div>
    </div>

    <div class="form-group row">
      <label for="aboutUs" class="col-sm-2 col-form-label">About Us</label>
      <div class="col-sm-10">
        <ckeditor :editor="editor" v-model="form.aboutUs"></ckeditor>
      </div>
      <small
        class="text-danger"
        v-if="errors.aboutUs"
        v-text="errors.aboutUs[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label for="privacyPolicy" class="col-sm-2 col-form-label"
        >Privacy Policy</label
      >
      <div class="col-sm-10">
        <ckeditor :editor="editor" v-model="form.privacyPolicy"></ckeditor>
      </div>
      <small
        class="text-danger"
        v-if="errors.privacyPolicy"
        v-text="errors.privacyPolicy[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label for="contactUs" class="col-sm-2 col-form-label">Contact Us</label>
      <div class="col-sm-10">
        <ckeditor :editor="editor" v-model="form.contactUs"> </ckeditor>
      </div>
      <small
        class="text-danger"
        v-if="errors.contactUs"
        v-text="errors.contactUs[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="copyright"
          placeholder="Copyright"
          v-model="form.copyrightText"
        />
      </div>
      <small
        class="text-danger"
        v-if="errors.copyrightText"
        v-text="errors.copyrightText[0]"
      ></small>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button
          v-if="!isLoading"
          :disabled="!form.title"
          type="submit"
          class="btn btn-success btn-sm"
        >
          Update
        </button>
        <button v-else disabled type="submit" class="btn btn-success btn-sm">
          Updating...
        </button>
      </div>
    </div>
  </form>
</template>
<script>
//import CryptoJs from "crypto-js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { mapGetters } from "vuex";
export default {
  components: {},
  data() {
    return {
      form: {
        faviconImage: null,
        title: null,
        logo: null,
        aboutUs: null,
        privacyPolicy: null,
        contactUs: null,
        copyrightText: null,
      },
      imagePreviews: {
        logo: null,
        faviconImage: null,
      },
      editor: ClassicEditor,
      errors: [],
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(["_Settings"]),
  },
  created() {
    let data = this._Settings;
    if (data) {
      this.form.faviconImage = data.faviconImage;
      this.form.title = data.title;
      this.form.logo = data.logo;
      this.form.aboutUs = data.aboutUs;
      this.form.privacyPolicy = data.privacyPolicy;
      this.form.contactUs = data.contactUs;
      this.form.copyrightText = data.copyrightText;
    }
  },
  methods: {
    update() {
      let settings = this.$store.state.Settings.settings;
      const formdata = new FormData();
      formdata.append("faviconImage", this.form.faviconImage);
      formdata.append("logo", this.form.logo);
      formdata.append("title", this.form.title);
      formdata.append("aboutUs", this.form.aboutUs);
      formdata.append("privacyPolicy", this.form.privacyPolicy);
      formdata.append("contactUs", this.form.contactUs);
      formdata.append("copyrightText", this.form.copyrightText);
      this.$appAxios
        .post("/updatesettings", formdata)
        .then(() => {
          settings.faviconImage = formdata.faviconImage;
          settings.title = formdata.title;
          settings.logo = formdata.logo;
          settings.aboutUs = formdata.aboutUs;
          settings.privacyPolicy = formdata.privacyPolicy;
          settings.contactUs = formdata.contactUs;
          settings.copyrightText = formdata.copyrightText;
          this.$notify({
            type: "success",
            title: "Settings updated successfully.",
          });
          this.errors = [];
        })
        .catch((err) => {
          this.$notify({
            type: "error",
            title: "Settings didn't updated.",
          });
          this.errors = err.response.data.errors;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    isUploadedFavicon(e) {
      let image = e.target.files[0];
      this.form.faviconImage = image;
      this.imagePreviews.faviconImage = URL.createObjectURL(image);
    },
    isUploadedLogo(e) {
      let logo = e.target.files[0]
      this.form.logo = logo;
      this.imagePreviews.logo = URL.createObjectURL(logo);
    },
  },
};
</script>
