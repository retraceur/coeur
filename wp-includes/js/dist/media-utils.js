"use strict";
var wp;
(wp ||= {}).mediaUtils = (() => {
  var __create = Object.create;
  var __defProp = Object.defineProperty;
  var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
  var __getOwnPropNames = Object.getOwnPropertyNames;
  var __getProtoOf = Object.getPrototypeOf;
  var __hasOwnProp = Object.prototype.hasOwnProperty;
  var __commonJS = (cb, mod) => function __require() {
    return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
  };
  var __export = (target, all) => {
    for (var name in all)
      __defProp(target, name, { get: all[name], enumerable: true });
  };
  var __copyProps = (to, from, except, desc) => {
    if (from && typeof from === "object" || typeof from === "function") {
      for (let key of __getOwnPropNames(from))
        if (!__hasOwnProp.call(to, key) && key !== except)
          __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
    }
    return to;
  };
  var __toESM = (mod, isNodeMode, target) => (target = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
    // If the importer is in node compatibility mode or this is not an ESM
    // file that has been converted to a CommonJS file using a Babel-
    // compatible transform (i.e. "__esModule" has not been set), then set
    // "default" to the CommonJS "module.exports" for node compatibility.
    isNodeMode || !mod || !mod.__esModule ? __defProp(target, "default", { value: mod, enumerable: true }) : target,
    mod
  ));
  var __toCommonJS = (mod) => __copyProps(__defProp({}, "__esModule", { value: true }), mod);

  // package-external:@wordpress/element
  var require_element = __commonJS({
    "package-external:@wordpress/element"(exports, module) {
      module.exports = window.wp.element;
    }
  });

  // package-external:@wordpress/i18n
  var require_i18n = __commonJS({
    "package-external:@wordpress/i18n"(exports, module) {
      module.exports = window.wp.i18n;
    }
  });

  // package-external:@wordpress/blob
  var require_blob = __commonJS({
    "package-external:@wordpress/blob"(exports, module) {
      module.exports = window.wp.blob;
    }
  });

  // package-external:@wordpress/api-fetch
  var require_api_fetch = __commonJS({
    "package-external:@wordpress/api-fetch"(exports, module) {
      module.exports = window.wp.apiFetch;
    }
  });

  // package-external:@wordpress/core-data
  var require_core_data = __commonJS({
    "package-external:@wordpress/core-data"(exports, module) {
      module.exports = window.wp.coreData;
    }
  });

  // package-external:@wordpress/data
  var require_data = __commonJS({
    "package-external:@wordpress/data"(exports, module) {
      module.exports = window.wp.data;
    }
  });

  // package-external:@wordpress/components
  var require_components = __commonJS({
    "package-external:@wordpress/components"(exports, module) {
      module.exports = window.wp.components;
    }
  });

  // package-external:@wordpress/primitives
  var require_primitives = __commonJS({
    "package-external:@wordpress/primitives"(exports, module) {
      module.exports = window.wp.primitives;
    }
  });

  // vendor-external:react/jsx-runtime
  var require_jsx_runtime = __commonJS({
    "vendor-external:react/jsx-runtime"(exports, module) {
      module.exports = window.ReactJSXRuntime;
    }
  });

  // package-external:@wordpress/dataviews
  var require_dataviews = __commonJS({
    "package-external:@wordpress/dataviews"(exports, module) {
      module.exports = window.wp.dataviews;
    }
  });

  // package-external:@wordpress/compose
  var require_compose = __commonJS({
    "package-external:@wordpress/compose"(exports, module) {
      module.exports = window.wp.compose;
    }
  });

  // package-external:@wordpress/date
  var require_date = __commonJS({
    "package-external:@wordpress/date"(exports, module) {
      module.exports = window.wp.date;
    }
  });

  // package-external:@wordpress/url
  var require_url = __commonJS({
    "package-external:@wordpress/url"(exports, module) {
      module.exports = window.wp.url;
    }
  });

  // package-external:@wordpress/notices
  var require_notices = __commonJS({
    "package-external:@wordpress/notices"(exports, module) {
      module.exports = window.wp.notices;
    }
  });

  // package-external:@wordpress/private-apis
  var require_private_apis = __commonJS({
    "package-external:@wordpress/private-apis"(exports, module) {
      module.exports = window.wp.privateApis;
    }
  });

  // packages/media-utils/build-module/index.mjs
  var index_exports = {};
  __export(index_exports, {
    MediaUpload: () => media_upload_default,
    privateApis: () => privateApis,
    transformAttachment: () => transformAttachment,
    uploadMedia: () => uploadMedia,
    validateFileSize: () => validateFileSize,
    validateMimeType: () => validateMimeType,
    validateMimeTypeForUser: () => validateMimeTypeForUser
  });

  // packages/media-utils/build-module/components/media-upload/index.mjs
  var import_element = __toESM(require_element(), 1);
  var import_i18n = __toESM(require_i18n(), 1);
  var DEFAULT_EMPTY_GALLERY = [];
  var getFeaturedImageMediaFrame = () => {
    const { wp } = window;
    return wp.media.view.MediaFrame.Select.extend({
      /**
       * Enables the Set Featured Image Button.
       *
       * @param {Object} toolbar toolbar for featured image state
       * @return {void}
       */
      featuredImageToolbar(toolbar) {
        this.createSelectToolbar(toolbar, {
          text: wp.media.view.l10n.setFeaturedImage,
          state: this.options.state
        });
      },
      /**
       * Handle the edit state requirements of selected media item.
       *
       * @return {void}
       */
      editState() {
        const selection = this.state("featured-image").get("selection");
        const view = new wp.media.view.EditImage({
          model: selection.single(),
          controller: this
        }).render();
        this.content.set(view);
        view.loadEditor();
      },
      /**
       * Create the default states.
       *
       * @return {void}
       */
      createStates: function createStates() {
        this.on(
          "toolbar:create:featured-image",
          this.featuredImageToolbar,
          this
        );
        this.on("content:render:edit-image", this.editState, this);
        this.states.add([
          new wp.media.controller.FeaturedImage(),
          new wp.media.controller.EditImage({
            model: this.options.editImage
          })
        ]);
      }
    });
  };
  var getSingleMediaFrame = () => {
    const { wp } = window;
    return wp.media.view.MediaFrame.Select.extend({
      /**
       * Create the default states on the frame.
       */
      createStates() {
        const options = this.options;
        if (this.options.states) {
          return;
        }
        this.states.add([
          // Main states.
          new wp.media.controller.Library({
            library: wp.media.query(options.library),
            multiple: options.multiple,
            title: options.title,
            priority: 20,
            filterable: "uploaded"
            // Allow filtering by uploaded images.
          }),
          new wp.media.controller.EditImage({
            model: options.editImage
          })
        ]);
      }
    });
  };
  var getGalleryDetailsMediaFrame = () => {
    const { wp } = window;
    return wp.media.view.MediaFrame.Post.extend({
      /**
       * Set up gallery toolbar.
       *
       * @return {void}
       */
      galleryToolbar() {
        const editing = this.state().get("editing");
        this.toolbar.set(
          new wp.media.view.Toolbar({
            controller: this,
            items: {
              insert: {
                style: "primary",
                text: editing ? wp.media.view.l10n.updateGallery : wp.media.view.l10n.insertGallery,
                priority: 80,
                requires: { library: true },
                /**
                 * @fires wp.media.controller.State#update
                 */
                click() {
                  const controller = this.controller, state = controller.state();
                  controller.close();
                  state.trigger(
                    "update",
                    state.get("library")
                  );
                  controller.setState(controller.options.state);
                  controller.reset();
                }
              }
            }
          })
        );
      },
      /**
       * Handle the edit state requirements of selected media item.
       *
       * @return {void}
       */
      editState() {
        const selection = this.state("gallery").get("selection");
        const view = new wp.media.view.EditImage({
          model: selection.single(),
          controller: this
        }).render();
        this.content.set(view);
        view.loadEditor();
      },
      /**
       * Create the default states.
       *
       * @return {void}
       */
      createStates: function createStates() {
        this.on("toolbar:create:main-gallery", this.galleryToolbar, this);
        this.on("content:render:edit-image", this.editState, this);
        this.states.add([
          new wp.media.controller.Library({
            id: "gallery",
            title: wp.media.view.l10n.createGalleryTitle,
            priority: 40,
            toolbar: "main-gallery",
            filterable: "uploaded",
            multiple: "add",
            editable: false,
            library: wp.media.query({
              type: "image",
              ...this.options.library
            })
          }),
          new wp.media.controller.EditImage({
            model: this.options.editImage
          }),
          new wp.media.controller.GalleryEdit({
            library: this.options.selection,
            editing: this.options.editing,
            menu: "gallery",
            displaySettings: false,
            multiple: true
          }),
          new wp.media.controller.GalleryAdd()
        ]);
      }
    });
  };
  var slimImageObject = (img) => {
    const attrSet = [
      "sizes",
      "mime",
      "type",
      "subtype",
      "id",
      "url",
      "alt",
      "link",
      "caption"
    ];
    return attrSet.reduce((result, key) => {
      if (img?.hasOwnProperty(key)) {
        result[key] = img[key];
      }
      return result;
    }, {});
  };
  var getAttachmentsCollection = (ids) => {
    const { wp } = window;
    return wp.media.query({
      order: "ASC",
      orderby: "post__in",
      post__in: ids,
      posts_per_page: -1,
      query: true,
      type: "image"
    });
  };
  var MediaUpload = class extends import_element.Component {
    constructor() {
      super(...arguments);
      this.openModal = this.openModal.bind(this);
      this.onOpen = this.onOpen.bind(this);
      this.onSelect = this.onSelect.bind(this);
      this.onUpdate = this.onUpdate.bind(this);
      this.onClose = this.onClose.bind(this);
    }
    initializeListeners() {
      this.frame.on("select", this.onSelect);
      this.frame.on("update", this.onUpdate);
      this.frame.on("open", this.onOpen);
      this.frame.on("close", this.onClose);
    }
    /**
     * Sets the Gallery frame and initializes listeners.
     *
     * @return {void}
     */
    buildAndSetGalleryFrame() {
      const {
        addToGallery = false,
        allowedTypes,
        multiple = false,
        value = DEFAULT_EMPTY_GALLERY
      } = this.props;
      if (value === this.lastGalleryValue) {
        return;
      }
      const { wp } = window;
      this.lastGalleryValue = value;
      if (this.frame) {
        this.frame.remove();
      }
      let currentState;
      if (addToGallery) {
        currentState = "gallery-library";
      } else {
        currentState = value && value.length ? "gallery-edit" : "gallery";
      }
      if (!this.GalleryDetailsMediaFrame) {
        this.GalleryDetailsMediaFrame = getGalleryDetailsMediaFrame();
      }
      const attachments = getAttachmentsCollection(value);
      const selection = new wp.media.model.Selection(attachments.models, {
        props: attachments.props.toJSON(),
        multiple
      });
      this.frame = new this.GalleryDetailsMediaFrame({
        mimeType: allowedTypes,
        state: currentState,
        multiple,
        selection,
        editing: !!value?.length
      });
      wp.media.frame = this.frame;
      this.initializeListeners();
    }
    /**
     * Initializes the Media Library requirements for the featured image flow.
     *
     * @return {void}
     */
    buildAndSetFeatureImageFrame() {
      const { wp } = window;
      const { value: featuredImageId, multiple, allowedTypes } = this.props;
      const featuredImageFrame = getFeaturedImageMediaFrame();
      const attachments = getAttachmentsCollection(featuredImageId);
      const selection = new wp.media.model.Selection(attachments.models, {
        props: attachments.props.toJSON()
      });
      this.frame = new featuredImageFrame({
        mimeType: allowedTypes,
        state: "featured-image",
        multiple,
        selection,
        editing: featuredImageId
      });
      wp.media.frame = this.frame;
      wp.media.view.settings.post = {
        ...wp.media.view.settings.post,
        featuredImageId: featuredImageId || -1
      };
    }
    /**
     * Initializes the Media Library requirements for the single image flow.
     *
     * @return {void}
     */
    buildAndSetSingleMediaFrame() {
      const { wp } = window;
      const {
        allowedTypes,
        multiple = false,
        title = (0, import_i18n.__)("Select or Upload Media"),
        value
      } = this.props;
      const frameConfig = {
        title,
        multiple
      };
      if (!!allowedTypes) {
        frameConfig.library = { type: allowedTypes };
      }
      if (this.frame) {
        this.frame.remove();
      }
      const singleImageFrame = getSingleMediaFrame();
      const attachments = getAttachmentsCollection(value);
      const selection = new wp.media.model.Selection(attachments.models, {
        props: attachments.props.toJSON()
      });
      this.frame = new singleImageFrame({
        mimeType: allowedTypes,
        multiple,
        selection,
        ...frameConfig
      });
      wp.media.frame = this.frame;
    }
    componentWillUnmount() {
      this.frame?.remove();
    }
    onUpdate(selections) {
      const { onSelect, multiple = false } = this.props;
      const state = this.frame.state();
      const selectedImages = selections || state.get("selection");
      if (!selectedImages || !selectedImages.models.length) {
        return;
      }
      if (multiple) {
        onSelect(
          selectedImages.models.map(
            (model) => slimImageObject(model.toJSON())
          )
        );
      } else {
        onSelect(slimImageObject(selectedImages.models[0].toJSON()));
      }
    }
    onSelect() {
      const { onSelect, multiple = false } = this.props;
      const attachment = this.frame.state().get("selection").toJSON();
      onSelect(multiple ? attachment : attachment[0]);
    }
    onOpen() {
      const { wp } = window;
      const { value } = this.props;
      this.updateCollection();
      if (this.props.mode) {
        this.frame.content.mode(this.props.mode);
      }
      const hasMedia = Array.isArray(value) ? !!value?.length : !!value;
      if (!hasMedia) {
        return;
      }
      const isGallery = this.props.gallery;
      const selection = this.frame.state().get("selection");
      const valueArray = Array.isArray(value) ? value : [value];
      if (!isGallery) {
        valueArray.forEach((id) => {
          selection.add(wp.media.attachment(id));
        });
      }
      const attachments = getAttachmentsCollection(valueArray);
      attachments.more().done(function() {
        if (isGallery && attachments?.models?.length) {
          selection.add(attachments.models);
        }
      });
    }
    onClose() {
      const { onClose } = this.props;
      if (onClose) {
        onClose();
      }
      this.frame.detach();
    }
    updateCollection() {
      const frameContent = this.frame.content.get();
      if (frameContent && frameContent.collection) {
        const collection = frameContent.collection;
        collection.toArray().forEach((model) => model.trigger("destroy", model));
        collection.mirroring._hasMore = true;
        collection.more();
      }
    }
    openModal() {
      const {
        gallery = false,
        unstableFeaturedImageFlow = false,
        modalClass
      } = this.props;
      if (gallery) {
        this.buildAndSetGalleryFrame();
      } else {
        this.buildAndSetSingleMediaFrame();
      }
      if (modalClass) {
        this.frame.$el.addClass(modalClass);
      }
      if (unstableFeaturedImageFlow) {
        this.buildAndSetFeatureImageFrame();
      }
      this.initializeListeners();
      this.frame.open();
    }
    render() {
      return this.props.render({ open: this.openModal });
    }
  };
  var media_upload_default = MediaUpload;

  // packages/media-utils/build-module/utils/upload-media.mjs
  var import_i18n5 = __toESM(require_i18n(), 1);
  var import_blob = __toESM(require_blob(), 1);

  // packages/media-utils/build-module/utils/upload-to-server.mjs
  var import_api_fetch = __toESM(require_api_fetch(), 1);

  // packages/media-utils/build-module/utils/flatten-form-data.mjs
  function isPlainObject(data) {
    return data !== null && typeof data === "object" && Object.getPrototypeOf(data) === Object.prototype;
  }
  function flattenFormData(formData, key, data) {
    if (isPlainObject(data)) {
      for (const [name, value] of Object.entries(data)) {
        flattenFormData(formData, `${key}[${name}]`, value);
      }
    } else if (data !== void 0) {
      formData.append(key, String(data));
    }
  }

  // packages/media-utils/build-module/utils/transform-attachment.mjs
  function transformAttachment(attachment) {
    const { alt_text, source_url, ...savedMediaProps } = attachment;
    return {
      ...savedMediaProps,
      alt: attachment.alt_text,
      caption: attachment.caption?.raw ?? "",
      title: attachment.title.raw,
      url: attachment.source_url,
      poster: attachment._embedded?.["wp:featuredmedia"]?.[0]?.source_url || void 0
    };
  }

  // packages/media-utils/build-module/utils/upload-to-server.mjs
  async function uploadToServer(file, additionalData = {}, signal) {
    const data = new FormData();
    data.append("file", file, file.name || file.type.replace("/", "."));
    for (const [key, value] of Object.entries(additionalData)) {
      flattenFormData(
        data,
        key,
        value
      );
    }
    return transformAttachment(
      await (0, import_api_fetch.default)({
        // This allows the video block to directly get a video's poster image.
        path: "/wp/v2/media?_embed=wp:featuredmedia",
        body: data,
        method: "POST",
        signal
      })
    );
  }

  // packages/media-utils/build-module/utils/validate-mime-type.mjs
  var import_i18n2 = __toESM(require_i18n(), 1);

  // packages/media-utils/build-module/utils/upload-error.mjs
  var UploadError = class extends Error {
    code;
    file;
    constructor({ code, message, file, cause }) {
      super(message, { cause });
      Object.setPrototypeOf(this, new.target.prototype);
      this.code = code;
      this.file = file;
    }
  };

  // packages/media-utils/build-module/utils/validate-mime-type.mjs
  function validateMimeType(file, allowedTypes) {
    if (!allowedTypes) {
      return;
    }
    const isAllowedType = allowedTypes.some((allowedType) => {
      if (allowedType.includes("/")) {
        return allowedType === file.type;
      }
      return file.type.startsWith(`${allowedType}/`);
    });
    if (file.type && !isAllowedType) {
      throw new UploadError({
        code: "MIME_TYPE_NOT_SUPPORTED",
        message: (0, import_i18n2.sprintf)(
          // translators: %s: file name.
          (0, import_i18n2.__)("%s: Sorry, this file type is not supported here."),
          file.name
        ),
        file
      });
    }
  }

  // packages/media-utils/build-module/utils/validate-mime-type-for-user.mjs
  var import_i18n3 = __toESM(require_i18n(), 1);

  // packages/media-utils/build-module/utils/get-mime-types-array.mjs
  function getMimeTypesArray(wpMimeTypesObject) {
    if (!wpMimeTypesObject) {
      return null;
    }
    return Object.entries(wpMimeTypesObject).flatMap(
      ([extensionsString, mime]) => {
        const [type] = mime.split("/");
        const extensions = extensionsString.split("|");
        return [
          mime,
          ...extensions.map(
            (extension) => `${type}/${extension}`
          )
        ];
      }
    );
  }

  // packages/media-utils/build-module/utils/validate-mime-type-for-user.mjs
  function validateMimeTypeForUser(file, wpAllowedMimeTypes) {
    const allowedMimeTypesForUser = getMimeTypesArray(wpAllowedMimeTypes);
    if (!allowedMimeTypesForUser) {
      return;
    }
    const isAllowedMimeTypeForUser = allowedMimeTypesForUser.includes(
      file.type
    );
    if (file.type && !isAllowedMimeTypeForUser) {
      throw new UploadError({
        code: "MIME_TYPE_NOT_ALLOWED_FOR_USER",
        message: (0, import_i18n3.sprintf)(
          // translators: %s: file name.
          (0, import_i18n3.__)(
            "%s: Sorry, you are not allowed to upload this file type."
          ),
          file.name
        ),
        file
      });
    }
  }

  // packages/media-utils/build-module/utils/validate-file-size.mjs
  var import_i18n4 = __toESM(require_i18n(), 1);
  function validateFileSize(file, maxUploadFileSize) {
    if (file.size <= 0) {
      throw new UploadError({
        code: "EMPTY_FILE",
        message: (0, import_i18n4.sprintf)(
          // translators: %s: file name.
          (0, import_i18n4.__)("%s: This file is empty."),
          file.name
        ),
        file
      });
    }
    if (maxUploadFileSize && file.size > maxUploadFileSize) {
      throw new UploadError({
        code: "SIZE_ABOVE_LIMIT",
        message: (0, import_i18n4.sprintf)(
          // translators: %s: file name.
          (0, import_i18n4.__)(
            "%s: This file exceeds the maximum upload size for this site."
          ),
          file.name
        ),
        file
      });
    }
  }

  // packages/media-utils/build-module/utils/upload-media.mjs
  function uploadMedia({
    wpAllowedMimeTypes,
    allowedTypes,
    additionalData = {},
    filesList,
    maxUploadFileSize,
    onError,
    onFileChange,
    signal,
    multiple = true
  }) {
    if (!multiple && filesList.length > 1) {
      onError?.(new Error((0, import_i18n5.__)("Only one file can be used here.")));
      return;
    }
    const validFiles = [];
    const filesSet = [];
    const setAndUpdateFiles = (index, value) => {
      if (!window.__clientSideMediaProcessing) {
        if (filesSet[index]?.url) {
          (0, import_blob.revokeBlobURL)(filesSet[index].url);
        }
      }
      filesSet[index] = value;
      onFileChange?.(
        filesSet.filter((attachment) => attachment !== null)
      );
    };
    for (const mediaFile of filesList) {
      try {
        validateMimeTypeForUser(mediaFile, wpAllowedMimeTypes);
      } catch (error) {
        onError?.(error);
        continue;
      }
      try {
        validateMimeType(mediaFile, allowedTypes);
      } catch (error) {
        onError?.(error);
        continue;
      }
      try {
        validateFileSize(mediaFile, maxUploadFileSize);
      } catch (error) {
        onError?.(error);
        continue;
      }
      validFiles.push(mediaFile);
      if (!window.__clientSideMediaProcessing) {
        filesSet.push({ url: (0, import_blob.createBlobURL)(mediaFile) });
        onFileChange?.(filesSet);
      }
    }
    validFiles.map(async (file, index) => {
      try {
        const attachment = await uploadToServer(
          file,
          additionalData,
          signal
        );
        setAndUpdateFiles(index, attachment);
      } catch (error) {
        setAndUpdateFiles(index, null);
        let message;
        if (typeof error === "object" && error !== null && "message" in error) {
          message = typeof error.message === "string" ? error.message : String(error.message);
        } else {
          message = (0, import_i18n5.sprintf)(
            // translators: %s: file name
            (0, import_i18n5.__)("Error while uploading file %s to the media library."),
            file.name
          );
        }
        onError?.(
          new UploadError({
            code: "GENERAL",
            message,
            file,
            cause: error instanceof Error ? error : void 0
          })
        );
      }
    });
  }

  // packages/media-utils/build-module/utils/sideload-media.mjs
  var import_i18n6 = __toESM(require_i18n(), 1);

  // packages/media-utils/build-module/utils/sideload-to-server.mjs
  var import_api_fetch2 = __toESM(require_api_fetch(), 1);
  async function sideloadToServer(file, attachmentId, additionalData = {}, signal) {
    const data = new FormData();
    data.append("file", file, file.name || file.type.replace("/", "."));
    for (const [key, value] of Object.entries(additionalData)) {
      flattenFormData(
        data,
        key,
        value
      );
    }
    return transformAttachment(
      await (0, import_api_fetch2.default)({
        path: `/wp/v2/media/${attachmentId}/sideload`,
        body: data,
        method: "POST",
        signal
      })
    );
  }

  // packages/media-utils/build-module/utils/sideload-media.mjs
  var noop = () => {
  };
  async function sideloadMedia({
    file,
    attachmentId,
    additionalData = {},
    signal,
    onFileChange,
    onError = noop
  }) {
    try {
      const attachment = await sideloadToServer(
        file,
        attachmentId,
        additionalData,
        signal
      );
      onFileChange?.([attachment]);
    } catch (error) {
      let message;
      if (error instanceof Error) {
        message = error.message;
      } else {
        message = (0, import_i18n6.sprintf)(
          // translators: %s: file name
          (0, import_i18n6.__)("Error while sideloading file %s to the server."),
          file.name
        );
      }
      onError(
        new UploadError({
          code: "GENERAL",
          message,
          file,
          cause: error instanceof Error ? error : void 0
        })
      );
    }
  }

  // packages/media-utils/build-module/components/media-upload-modal/index.mjs
  var import_element7 = __toESM(require_element(), 1);
  var import_i18n23 = __toESM(require_i18n(), 1);
  var import_core_data4 = __toESM(require_core_data(), 1);
  var import_data4 = __toESM(require_data(), 1);
  var import_components8 = __toESM(require_components(), 1);

  // packages/icons/build-module/library/audio.mjs
  var import_primitives = __toESM(require_primitives(), 1);
  var import_jsx_runtime = __toESM(require_jsx_runtime(), 1);
  var audio_default = /* @__PURE__ */ (0, import_jsx_runtime.jsx)(import_primitives.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime.jsx)(import_primitives.Path, { d: "M17.7 4.3c-1.2 0-2.8 0-3.8 1-.6.6-.9 1.5-.9 2.6V14c-.6-.6-1.5-1-2.5-1C8.6 13 7 14.6 7 16.5S8.6 20 10.5 20c1.5 0 2.8-1 3.3-2.3.5-.8.7-1.8.7-2.5V7.9c0-.7.2-1.2.5-1.6.6-.6 1.8-.6 2.8-.6h.3V4.3h-.4z" }) });

  // packages/icons/build-module/library/comment-author-avatar.mjs
  var import_primitives2 = __toESM(require_primitives(), 1);
  var import_jsx_runtime2 = __toESM(require_jsx_runtime(), 1);
  var comment_author_avatar_default = /* @__PURE__ */ (0, import_jsx_runtime2.jsx)(import_primitives2.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime2.jsx)(import_primitives2.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M7.25 16.437a6.5 6.5 0 1 1 9.5 0V16A2.75 2.75 0 0 0 14 13.25h-4A2.75 2.75 0 0 0 7.25 16v.437Zm1.5 1.193a6.47 6.47 0 0 0 3.25.87 6.47 6.47 0 0 0 3.25-.87V16c0-.69-.56-1.25-1.25-1.25h-4c-.69 0-1.25.56-1.25 1.25v1.63ZM4 12a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm10-2a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" }) });

  // packages/icons/build-module/library/file.mjs
  var import_primitives3 = __toESM(require_primitives(), 1);
  var import_jsx_runtime3 = __toESM(require_jsx_runtime(), 1);
  var file_default = /* @__PURE__ */ (0, import_jsx_runtime3.jsx)(import_primitives3.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime3.jsx)(import_primitives3.Path, { fillRule: "evenodd", clipRule: "evenodd", d: "M12.848 8a1 1 0 0 1-.914-.594l-.723-1.63a.5.5 0 0 0-.447-.276H5a.5.5 0 0 0-.5.5v11.5a.5.5 0 0 0 .5.5h14a.5.5 0 0 0 .5-.5v-9A.5.5 0 0 0 19 8h-6.152Zm.612-1.5a.5.5 0 0 1-.462-.31l-.445-1.084A2 2 0 0 0 10.763 4H5a2 2 0 0 0-2 2v11.5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2h-5.54Z" }) });

  // packages/icons/build-module/library/image.mjs
  var import_primitives4 = __toESM(require_primitives(), 1);
  var import_jsx_runtime4 = __toESM(require_jsx_runtime(), 1);
  var image_default = /* @__PURE__ */ (0, import_jsx_runtime4.jsx)(import_primitives4.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime4.jsx)(import_primitives4.Path, { d: "M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 4.5h14c.3 0 .5.2.5.5v8.4l-3-2.9c-.3-.3-.8-.3-1 0L11.9 14 9 12c-.3-.2-.6-.2-.8 0l-3.6 2.6V5c-.1-.3.1-.5.4-.5zm14 15H5c-.3 0-.5-.2-.5-.5v-2.4l4.1-3 3 1.9c.3.2.7.2.9-.1L16 12l3.5 3.4V19c0 .3-.2.5-.5.5z" }) });

  // packages/icons/build-module/library/upload.mjs
  var import_primitives5 = __toESM(require_primitives(), 1);
  var import_jsx_runtime5 = __toESM(require_jsx_runtime(), 1);
  var upload_default = /* @__PURE__ */ (0, import_jsx_runtime5.jsx)(import_primitives5.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime5.jsx)(import_primitives5.Path, { d: "M18.5 15v3.5H13V6.7l4.5 4.1 1-1.1-6.2-5.8-5.8 5.8 1 1.1 4-4v11.7h-6V15H4v5h16v-5z" }) });

  // packages/icons/build-module/library/video.mjs
  var import_primitives6 = __toESM(require_primitives(), 1);
  var import_jsx_runtime6 = __toESM(require_jsx_runtime(), 1);
  var video_default = /* @__PURE__ */ (0, import_jsx_runtime6.jsx)(import_primitives6.SVG, { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 24 24", children: /* @__PURE__ */ (0, import_jsx_runtime6.jsx)(import_primitives6.Path, { d: "M18.7 3H5.3C4 3 3 4 3 5.3v13.4C3 20 4 21 5.3 21h13.4c1.3 0 2.3-1 2.3-2.3V5.3C21 4 20 3 18.7 3zm.8 15.7c0 .4-.4.8-.8.8H5.3c-.4 0-.8-.4-.8-.8V5.3c0-.4.4-.8.8-.8h13.4c.4 0 .8.4.8.8v13.4zM10 15l5-3-5-3v6z" }) });

  // packages/media-utils/build-module/components/media-upload-modal/index.mjs
  var import_dataviews = __toESM(require_dataviews(), 1);

  // packages/media-fields/build-module/alt_text/index.mjs
  var import_i18n7 = __toESM(require_i18n(), 1);
  var import_components = __toESM(require_components(), 1);
  var import_jsx_runtime7 = __toESM(require_jsx_runtime(), 1);
  var altTextField = {
    id: "alt_text",
    type: "text",
    label: (0, import_i18n7.__)("Alt text"),
    isVisible: (item) => item?.media_type === "image",
    render: ({ item }) => item?.alt_text || "-",
    Edit: ({ field, onChange, data }) => {
      return /* @__PURE__ */ (0, import_jsx_runtime7.jsx)(
        import_components.TextareaControl,
        {
          label: field.label,
          value: data.alt_text || "",
          onChange: (value) => onChange({ alt_text: value }),
          rows: 2
        }
      );
    },
    enableSorting: false,
    filterBy: false
  };
  var alt_text_default = altTextField;

  // packages/media-fields/build-module/attached_to/index.mjs
  var import_i18n10 = __toESM(require_i18n(), 1);

  // packages/media-fields/build-module/attached_to/view.mjs
  var import_element2 = __toESM(require_element(), 1);
  var import_i18n8 = __toESM(require_i18n(), 1);

  // packages/media-fields/build-module/utils/get-rendered-content.mjs
  function getRenderedContent(content) {
    if (!content) {
      return "";
    }
    if (typeof content === "string") {
      return content;
    }
    if (typeof content === "object") {
      return content.rendered || content.raw || "";
    }
    return "";
  }

  // packages/media-fields/build-module/attached_to/view.mjs
  var import_jsx_runtime8 = __toESM(require_jsx_runtime(), 1);
  function MediaAttachedToView({
    item
  }) {
    const [attachedPostTitle, setAttachedPostTitle] = (0, import_element2.useState)(null);
    const parentId = item.post;
    const embeddedPostId = item._embedded?.["wp:attached-to"]?.[0]?.id;
    const embeddedPostTitle = item._embedded?.["wp:attached-to"]?.[0]?.title;
    (0, import_element2.useEffect)(() => {
      if (!!parentId && parentId === embeddedPostId) {
        setAttachedPostTitle(
          getRenderedContent(embeddedPostTitle) || embeddedPostId?.toString() || ""
        );
      }
      if (!parentId) {
        setAttachedPostTitle((0, import_i18n8.__)("(Unattached)"));
      }
    }, [parentId, embeddedPostId, embeddedPostTitle]);
    return /* @__PURE__ */ (0, import_jsx_runtime8.jsx)(import_jsx_runtime8.Fragment, { children: attachedPostTitle });
  }

  // packages/media-fields/build-module/attached_to/edit.mjs
  var import_core_data = __toESM(require_core_data(), 1);
  var import_components2 = __toESM(require_components(), 1);
  var import_i18n9 = __toESM(require_i18n(), 1);
  var import_element3 = __toESM(require_element(), 1);
  var import_compose = __toESM(require_compose(), 1);
  var import_data = __toESM(require_data(), 1);
  var import_jsx_runtime9 = __toESM(require_jsx_runtime(), 1);
  function MediaAttachedToEdit({
    data,
    onChange
  }) {
    const defaultPost = !!data.post && !!data?._embedded?.["wp:attached-to"]?.[0] ? [
      {
        label: getRenderedContent(
          data._embedded?.["wp:attached-to"]?.[0]?.title
        ),
        value: data.post.toString()
      }
    ] : [];
    const [options, setOptions] = (0, import_element3.useState)(defaultPost);
    const [searchResults, setSearchResults] = (0, import_element3.useState)(
      []
    );
    const [isLoading, setIsLoading] = (0, import_element3.useState)(false);
    const [value, setValue] = (0, import_element3.useState)(
      data?.post?.toString() ?? null
    );
    const postTypes = (0, import_data.useSelect)(
      (select) => select(import_core_data.store).getPostTypes(),
      []
    );
    const handleDetach = () => {
      onChange({
        post: 0,
        _embedded: { ...data?._embedded, "wp:attached-to": void 0 }
      });
      setOptions([]);
    };
    const onValueChange = async (filterValue) => {
      setIsLoading(true);
      const results = await (0, import_core_data.__experimentalFetchLinkSuggestions)(
        filterValue,
        /*
         * @TODO `fetchLinkSuggestions()` should accept `perPage` as an option argument.
         * `isInitialSuggestions` limits the result to 3, otherwise it's hardcoded to 20.
         */
        { type: "post", isInitialSuggestions: true },
        {}
      );
      setSearchResults(results);
      const mappedSuggestions = results.map((result) => {
        return {
          label: result.title,
          value: result.id.toString()
        };
      });
      setOptions(mappedSuggestions);
      setIsLoading(false);
    };
    const handleSelectOption = (selectedPostId) => {
      if (!selectedPostId) {
        handleDetach();
        return;
      }
      setValue(selectedPostId);
      if (selectedPostId) {
        const selectedPost = searchResults.find(
          (result) => result.id === Number(selectedPostId)
        );
        if (selectedPost && postTypes) {
          const postType = postTypes.find(
            (_postType) => _postType.slug === selectedPost?.type
          );
          const attachedTo = {
            ...postType && { type: postType.slug },
            id: Number(selectedPostId),
            title: {
              raw: selectedPost.title,
              rendered: selectedPost.title
            }
          };
          onChange({
            post: Number(selectedPostId),
            _embedded: {
              ...data?._embedded,
              "wp:attached-to": [attachedTo]
            }
          });
        }
      }
    };
    const help = !!data.post ? (0, import_element3.createInterpolateElement)(
      (0, import_i18n9.__)(
        "Search for a post or page to attach this media to or <button>detach current</button>."
      ),
      {
        button: /* @__PURE__ */ (0, import_jsx_runtime9.jsx)(
          import_components2.Button,
          {
            __next40pxDefaultSize: true,
            onClick: handleDetach,
            variant: "link",
            accessibleWhenDisabled: true
          }
        )
      }
    ) : (0, import_i18n9.__)("Search for a post or page to attach this media to.");
    return /* @__PURE__ */ (0, import_jsx_runtime9.jsx)(
      import_components2.ComboboxControl,
      {
        className: "dataviews-media-field__attached-to",
        __next40pxDefaultSize: true,
        isLoading,
        label: (0, import_i18n9.__)("Attached to"),
        help,
        value,
        options,
        onFilterValueChange: (0, import_compose.debounce)(
          (filterValue) => onValueChange(filterValue),
          300
        ),
        onChange: handleSelectOption,
        hideLabelFromVision: true
      }
    );
  }

  // packages/media-fields/build-module/attached_to/index.mjs
  var attachedToField = {
    id: "attached_to",
    type: "text",
    label: (0, import_i18n10.__)("Attached to"),
    Edit: MediaAttachedToEdit,
    render: MediaAttachedToView,
    enableSorting: false,
    filterBy: false
  };
  var attached_to_default = attachedToField;

  // packages/media-fields/build-module/author/index.mjs
  var import_i18n12 = __toESM(require_i18n(), 1);
  var import_data2 = __toESM(require_data(), 1);
  var import_core_data2 = __toESM(require_core_data(), 1);

  // node_modules/clsx/dist/clsx.mjs
  function r(e) {
    var t, f, n = "";
    if ("string" == typeof e || "number" == typeof e) n += e;
    else if ("object" == typeof e) if (Array.isArray(e)) {
      var o = e.length;
      for (t = 0; t < o; t++) e[t] && (f = r(e[t])) && (n && (n += " "), n += f);
    } else for (f in e) e[f] && (n && (n += " "), n += f);
    return n;
  }
  function clsx() {
    for (var e, t, f = 0, n = "", o = arguments.length; f < o; f++) (e = arguments[f]) && (t = r(e)) && (n && (n += " "), n += t);
    return n;
  }
  var clsx_default = clsx;

  // packages/media-fields/build-module/author/view.mjs
  var import_i18n11 = __toESM(require_i18n(), 1);
  var import_element4 = __toESM(require_element(), 1);
  var import_components3 = __toESM(require_components(), 1);
  var import_jsx_runtime10 = __toESM(require_jsx_runtime(), 1);
  function AuthorView({
    item
  }) {
    const author = item?._embedded?.author?.[0];
    const text = author?.name;
    const imageUrl = author?.avatar_urls?.[48];
    const [loadingState, setLoadingState] = (0, import_element4.useState)("loading");
    (0, import_element4.useEffect)(() => {
      setLoadingState("loading");
    }, [imageUrl]);
    const imgRef = (0, import_element4.useCallback)((img) => {
      if (img?.complete) {
        setLoadingState("instant");
      }
    }, []);
    const handleLoad = () => {
      if (loadingState === "loading") {
        setLoadingState("loaded");
      }
    };
    return /* @__PURE__ */ (0, import_jsx_runtime10.jsxs)(import_components3.__experimentalHStack, { alignment: "left", spacing: 0, children: [
      !!imageUrl && /* @__PURE__ */ (0, import_jsx_runtime10.jsx)(
        "div",
        {
          className: clsx_default("media-author-field__avatar", {
            "is-loading": loadingState === "loading",
            "is-loaded": loadingState === "loaded"
          }),
          children: /* @__PURE__ */ (0, import_jsx_runtime10.jsx)(
            "img",
            {
              ref: imgRef,
              onLoad: handleLoad,
              alt: (0, import_i18n11.__)("Author avatar"),
              src: imageUrl
            }
          )
        }
      ),
      !imageUrl && /* @__PURE__ */ (0, import_jsx_runtime10.jsx)("div", { className: "media-author-field__icon", children: /* @__PURE__ */ (0, import_jsx_runtime10.jsx)(import_components3.Icon, { icon: comment_author_avatar_default }) }),
      /* @__PURE__ */ (0, import_jsx_runtime10.jsx)("span", { className: "media-author-field__name", children: text })
    ] });
  }

  // packages/media-fields/build-module/author/index.mjs
  var authorField = {
    label: (0, import_i18n12.__)("Author"),
    id: "author",
    type: "integer",
    getElements: async () => {
      const authors = await (0, import_data2.resolveSelect)(import_core_data2.store).getEntityRecords(
        "root",
        "user",
        {
          per_page: -1,
          who: "authors",
          _fields: "id,name",
          context: "view"
        }
      ) ?? [];
      return authors.map(({ id, name }) => ({
        value: id,
        label: name
      }));
    },
    render: AuthorView,
    sort: (a, b, direction) => {
      const nameA = a._embedded?.author?.[0]?.name || "";
      const nameB = b._embedded?.author?.[0]?.name || "";
      return direction === "asc" ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    },
    filterBy: {
      operators: ["isAny", "isNone"]
    },
    readOnly: true
  };
  var author_default = authorField;

  // packages/media-fields/build-module/caption/index.mjs
  var import_i18n13 = __toESM(require_i18n(), 1);
  var import_components4 = __toESM(require_components(), 1);

  // packages/media-fields/build-module/utils/get-raw-content.mjs
  function getRawContent(content) {
    if (!content) {
      return "";
    }
    if (typeof content === "string") {
      return content;
    }
    if (typeof content === "object" && "raw" in content) {
      return content.raw || "";
    }
    return "";
  }

  // packages/media-fields/build-module/caption/index.mjs
  var import_jsx_runtime11 = __toESM(require_jsx_runtime(), 1);
  var captionField = {
    id: "caption",
    type: "text",
    label: (0, import_i18n13.__)("Caption"),
    getValue: ({ item }) => getRawContent(item?.caption),
    render: ({ item }) => getRawContent(item?.caption) || "-",
    Edit: ({ field, onChange, data }) => {
      return /* @__PURE__ */ (0, import_jsx_runtime11.jsx)(
        import_components4.TextareaControl,
        {
          label: field.label,
          value: getRawContent(data.caption) || "",
          onChange: (value) => onChange({ caption: value }),
          rows: 2
        }
      );
    },
    enableSorting: false,
    filterBy: false
  };
  var caption_default = captionField;

  // packages/media-fields/build-module/date_added/index.mjs
  var import_i18n14 = __toESM(require_i18n(), 1);
  var import_date = __toESM(require_date(), 1);
  var dateAddedField = {
    id: "date",
    type: "datetime",
    label: (0, import_i18n14.__)("Date added"),
    filterBy: {
      operators: ["before", "after"]
    },
    format: {
      datetime: (0, import_date.getSettings)().formats.datetimeAbbreviated
    },
    readOnly: true
  };
  var date_added_default = dateAddedField;

  // packages/media-fields/build-module/date_modified/index.mjs
  var import_i18n15 = __toESM(require_i18n(), 1);
  var import_date2 = __toESM(require_date(), 1);
  var dateModifiedField = {
    id: "modified",
    type: "datetime",
    label: (0, import_i18n15.__)("Date modified"),
    filterBy: {
      operators: ["before", "after"]
    },
    format: {
      datetime: (0, import_date2.getSettings)().formats.datetimeAbbreviated
    },
    readOnly: true
  };
  var date_modified_default = dateModifiedField;

  // packages/media-fields/build-module/description/index.mjs
  var import_i18n16 = __toESM(require_i18n(), 1);
  var import_components5 = __toESM(require_components(), 1);
  var import_jsx_runtime12 = __toESM(require_jsx_runtime(), 1);
  var descriptionField = {
    id: "description",
    type: "text",
    label: (0, import_i18n16.__)("Description"),
    getValue: ({ item }) => getRawContent(item?.description),
    render: ({ item }) => /* @__PURE__ */ (0, import_jsx_runtime12.jsx)("div", { children: getRawContent(item?.description) || "-" }),
    Edit: ({ field, onChange, data }) => {
      return /* @__PURE__ */ (0, import_jsx_runtime12.jsx)(
        import_components5.TextareaControl,
        {
          label: field.label,
          value: getRawContent(data.description) || "",
          onChange: (value) => onChange({ description: value }),
          rows: 5
        }
      );
    },
    enableSorting: false,
    filterBy: false
  };
  var description_default = descriptionField;

  // packages/media-fields/build-module/filename/index.mjs
  var import_i18n17 = __toESM(require_i18n(), 1);
  var import_url2 = __toESM(require_url(), 1);

  // packages/media-fields/build-module/filename/view.mjs
  var import_components6 = __toESM(require_components(), 1);
  var import_element5 = __toESM(require_element(), 1);
  var import_url = __toESM(require_url(), 1);
  var import_jsx_runtime13 = __toESM(require_jsx_runtime(), 1);
  var TRUNCATE_LENGTH = 15;
  function FileNameView({
    item
  }) {
    const fileName = (0, import_element5.useMemo)(
      () => item?.source_url ? (0, import_url.getFilename)(item.source_url) : null,
      [item?.source_url]
    );
    if (!fileName) {
      return "";
    }
    return fileName.length > TRUNCATE_LENGTH ? /* @__PURE__ */ (0, import_jsx_runtime13.jsx)(import_components6.Tooltip, { text: fileName, children: /* @__PURE__ */ (0, import_jsx_runtime13.jsx)(import_components6.__experimentalTruncate, { limit: TRUNCATE_LENGTH, ellipsizeMode: "tail", children: fileName }) }) : /* @__PURE__ */ (0, import_jsx_runtime13.jsx)(import_jsx_runtime13.Fragment, { children: fileName });
  }

  // packages/media-fields/build-module/filename/index.mjs
  var filenameField = {
    id: "filename",
    type: "text",
    label: (0, import_i18n17.__)("File name"),
    getValue: ({ item }) => (0, import_url2.getFilename)(item?.source_url || ""),
    render: FileNameView,
    enableSorting: false,
    filterBy: false,
    readOnly: true
  };
  var filename_default = filenameField;

  // packages/media-fields/build-module/filesize/index.mjs
  var import_i18n18 = __toESM(require_i18n(), 1);
  var KB_IN_BYTES = 1024;
  var MB_IN_BYTES = 1024 * KB_IN_BYTES;
  var GB_IN_BYTES = 1024 * MB_IN_BYTES;
  var TB_IN_BYTES = 1024 * GB_IN_BYTES;
  var PB_IN_BYTES = 1024 * TB_IN_BYTES;
  var EB_IN_BYTES = 1024 * PB_IN_BYTES;
  var ZB_IN_BYTES = 1024 * EB_IN_BYTES;
  var YB_IN_BYTES = 1024 * ZB_IN_BYTES;
  function getBytesString(bytes, unitSymbol, decimals = 2) {
    return (0, import_i18n18.sprintf)(
      // translators: 1: Actual bytes of a file. 2: The unit symbol (e.g. MB).
      (0, import_i18n18._x)("%1$s %2$s", "file size"),
      bytes.toLocaleString(void 0, {
        minimumFractionDigits: 0,
        maximumFractionDigits: decimals
      }),
      unitSymbol
    );
  }
  function formatFileSize(bytes, decimals = 2) {
    if (bytes === 0) {
      return getBytesString(0, (0, import_i18n18._x)("B", "unit symbol"), decimals);
    }
    const quant = {
      /* translators: Unit symbol for yottabyte. */
      [(0, import_i18n18._x)("YB", "unit symbol")]: YB_IN_BYTES,
      /* translators: Unit symbol for zettabyte. */
      [(0, import_i18n18._x)("ZB", "unit symbol")]: ZB_IN_BYTES,
      /* translators: Unit symbol for exabyte. */
      [(0, import_i18n18._x)("EB", "unit symbol")]: EB_IN_BYTES,
      /* translators: Unit symbol for petabyte. */
      [(0, import_i18n18._x)("PB", "unit symbol")]: PB_IN_BYTES,
      /* translators: Unit symbol for terabyte. */
      [(0, import_i18n18._x)("TB", "unit symbol")]: TB_IN_BYTES,
      /* translators: Unit symbol for gigabyte. */
      [(0, import_i18n18._x)("GB", "unit symbol")]: GB_IN_BYTES,
      /* translators: Unit symbol for megabyte. */
      [(0, import_i18n18._x)("MB", "unit symbol")]: MB_IN_BYTES,
      /* translators: Unit symbol for kilobyte. */
      [(0, import_i18n18._x)("KB", "unit symbol")]: KB_IN_BYTES,
      /* translators: Unit symbol for byte. */
      [(0, import_i18n18._x)("B", "unit symbol")]: 1
    };
    for (const [unit, mag] of Object.entries(quant)) {
      if (bytes >= mag) {
        return getBytesString(bytes / mag, unit, decimals);
      }
    }
    return "";
  }
  var filesizeField = {
    id: "filesize",
    type: "text",
    label: (0, import_i18n18.__)("File size"),
    getValue: ({ item }) => item?.media_details?.filesize ? formatFileSize(item?.media_details?.filesize) : "",
    isVisible: (item) => {
      return !!item?.media_details?.filesize;
    },
    enableSorting: false,
    filterBy: false,
    readOnly: true
  };
  var filesize_default = filesizeField;

  // packages/media-fields/build-module/media_dimensions/index.mjs
  var import_i18n19 = __toESM(require_i18n(), 1);
  var mediaDimensionsField = {
    id: "media_dimensions",
    type: "text",
    label: (0, import_i18n19.__)("Dimensions"),
    getValue: ({ item }) => item?.media_details?.width && item?.media_details?.height ? (0, import_i18n19.sprintf)(
      // translators: 1: Width. 2: Height.
      (0, import_i18n19._x)("%1$s \xD7 %2$s", "image dimensions"),
      item?.media_details?.width?.toString(),
      item?.media_details?.height?.toString()
    ) : "",
    isVisible: (item) => {
      return !!(item?.media_details?.width && item?.media_details?.height);
    },
    enableSorting: false,
    filterBy: false,
    readOnly: true
  };
  var media_dimensions_default = mediaDimensionsField;

  // packages/media-fields/build-module/media_thumbnail/index.mjs
  var import_i18n21 = __toESM(require_i18n(), 1);

  // packages/media-fields/build-module/media_thumbnail/view.mjs
  var import_data3 = __toESM(require_data(), 1);
  var import_core_data3 = __toESM(require_core_data(), 1);
  var import_components7 = __toESM(require_components(), 1);
  var import_element6 = __toESM(require_element(), 1);
  var import_url3 = __toESM(require_url(), 1);

  // packages/media-fields/build-module/utils/get-media-type-from-mime-type.mjs
  var import_i18n20 = __toESM(require_i18n(), 1);
  function getMediaTypeFromMimeType(mimeType) {
    if (mimeType.startsWith("image/")) {
      return {
        type: "image",
        label: (0, import_i18n20.__)("Image"),
        icon: image_default
      };
    }
    if (mimeType.startsWith("video/")) {
      return {
        type: "video",
        label: (0, import_i18n20.__)("Video"),
        icon: video_default
      };
    }
    if (mimeType.startsWith("audio/")) {
      return {
        type: "audio",
        label: (0, import_i18n20.__)("Audio"),
        icon: audio_default
      };
    }
    return {
      type: "application",
      label: (0, import_i18n20.__)("Application"),
      icon: file_default
    };
  }

  // packages/media-fields/build-module/media_thumbnail/view.mjs
  var import_jsx_runtime14 = __toESM(require_jsx_runtime(), 1);
  function FallbackView({
    item,
    filename
  }) {
    return /* @__PURE__ */ (0, import_jsx_runtime14.jsx)("div", { className: "dataviews-media-field__media-thumbnail", children: /* @__PURE__ */ (0, import_jsx_runtime14.jsxs)(
      import_components7.__experimentalVStack,
      {
        justify: "center",
        alignment: "center",
        className: "dataviews-media-field__media-thumbnail__stack",
        spacing: 0,
        children: [
          /* @__PURE__ */ (0, import_jsx_runtime14.jsx)(
            import_components7.Icon,
            {
              className: "dataviews-media-field__media-thumbnail--icon",
              icon: getMediaTypeFromMimeType(item.mime_type).icon,
              size: 24
            }
          ),
          !!filename && /* @__PURE__ */ (0, import_jsx_runtime14.jsx)("div", { className: "dataviews-media-field__media-thumbnail__filename", children: /* @__PURE__ */ (0, import_jsx_runtime14.jsx)(import_components7.__experimentalTruncate, { className: "dataviews-media-field__media-thumbnail__filename__truncate", children: filename }) })
        ]
      }
    ) });
  }
  function MediaThumbnailView({
    item,
    config
  }) {
    const [imageError, setImageError] = (0, import_element6.useState)(false);
    const _featuredMedia = (0, import_data3.useSelect)(
      (select) => {
        if (!item.featured_media) {
          return;
        }
        return select(import_core_data3.store).getEntityRecord(
          "postType",
          "attachment",
          item.featured_media
        );
      },
      [item.featured_media]
    );
    const featuredMedia = item.featured_media ? _featuredMedia : item;
    if (!featuredMedia) {
      return null;
    }
    const filename = (0, import_url3.getFilename)(featuredMedia.source_url || "");
    if (imageError || getMediaTypeFromMimeType(featuredMedia.mime_type).type !== "image") {
      return /* @__PURE__ */ (0, import_jsx_runtime14.jsx)(FallbackView, { item: featuredMedia, filename: filename || "" });
    }
    return /* @__PURE__ */ (0, import_jsx_runtime14.jsx)("div", { className: "dataviews-media-field__media-thumbnail", children: /* @__PURE__ */ (0, import_jsx_runtime14.jsx)(
      "img",
      {
        className: "dataviews-media-field__media-thumbnail--image",
        src: featuredMedia.source_url,
        srcSet: featuredMedia?.media_details?.sizes ? Object.values(
          featuredMedia.media_details.sizes
        ).map(
          (size) => `${size.source_url} ${size.width}w`
        ).join(", ") : void 0,
        sizes: config?.sizes || "100vw",
        alt: featuredMedia.alt_text || featuredMedia.title.raw,
        onError: () => setImageError(true)
      }
    ) });
  }

  // packages/media-fields/build-module/media_thumbnail/index.mjs
  var mediaThumbnailField = {
    id: "media_thumbnail",
    type: "media",
    label: (0, import_i18n21.__)("Thumbnail"),
    render: MediaThumbnailView,
    enableSorting: false,
    filterBy: false
  };
  var media_thumbnail_default = mediaThumbnailField;

  // packages/media-fields/build-module/mime_type/index.mjs
  var import_i18n22 = __toESM(require_i18n(), 1);
  var mimeTypeField = {
    id: "mime_type",
    type: "text",
    label: (0, import_i18n22.__)("File type"),
    getValue: ({ item }) => item?.mime_type || "",
    render: ({ item }) => item?.mime_type || "-",
    // Disable sorting until REST API support for ordering my `mime_type` is added.
    enableSorting: false,
    filterBy: false,
    readOnly: true
  };
  var mime_type_default = mimeTypeField;

  // packages/media-utils/build-module/components/media-upload-modal/index.mjs
  var import_notices = __toESM(require_notices(), 1);
  var import_blob2 = __toESM(require_blob(), 1);

  // packages/media-utils/build-module/lock-unlock.mjs
  var import_private_apis = __toESM(require_private_apis(), 1);
  var { lock, unlock } = (0, import_private_apis.__dangerousOptInToUnstableAPIsOnlyForCoreModules)(
    "I acknowledge private features are not for use in themes or plugins and doing so will break in the next version of Retraceur.",
    "@wordpress/media-utils"
  );

  // packages/media-utils/build-module/components/media-upload-modal/index.mjs
  var import_jsx_runtime15 = __toESM(require_jsx_runtime(), 1);
  var { useEntityRecordsWithPermissions } = unlock(import_core_data4.privateApis);
  var LAYOUT_PICKER_GRID = "pickerGrid";
  var LAYOUT_PICKER_TABLE = "pickerTable";
  var NOTICES_CONTEXT = "media-modal";
  var NOTICE_ID_UPLOAD_PROGRESS = "media-modal-upload-progress";
  function MediaUploadModal({
    allowedTypes,
    multiple = false,
    value,
    onSelect,
    onClose,
    onUpload,
    title = (0, import_i18n23.__)("Select Media"),
    isOpen,
    isDismissible = true,
    modalClass,
    search = true,
    searchLabel = (0, import_i18n23.__)("Search media")
  }) {
    const [selection, setSelection] = (0, import_element7.useState)(() => {
      if (!value) {
        return [];
      }
      return Array.isArray(value) ? value.map(String) : [String(value)];
    });
    const { createSuccessNotice, createErrorNotice, createInfoNotice } = (0, import_data4.useDispatch)(import_notices.store);
    const { invalidateResolution } = (0, import_data4.useDispatch)(import_core_data4.store);
    const [view, setView] = (0, import_element7.useState)(() => ({
      type: LAYOUT_PICKER_GRID,
      fields: [],
      showTitle: false,
      titleField: "title",
      mediaField: "media_thumbnail",
      search: "",
      page: 1,
      perPage: 20,
      filters: [],
      layout: {
        previewSize: 170
      }
    }));
    const queryArgs = (0, import_element7.useMemo)(() => {
      const filters = {};
      view.filters?.forEach((filter) => {
        if (filter.field === "media_type") {
          filters.media_type = filter.value;
        }
        if (filter.field === "author") {
          if (filter.operator === "isAny") {
            filters.author = filter.value;
          } else if (filter.operator === "isNone") {
            filters.author_exclude = filter.value;
          }
        }
        if (filter.field === "date" || filter.field === "modified") {
          if (filter.operator === "before") {
            filters.before = filter.value;
          } else if (filter.operator === "after") {
            filters.after = filter.value;
          }
        }
        if (filter.field === "mime_type") {
          filters.mime_type = filter.value;
        }
      });
      if (!filters.media_type) {
        filters.media_type = allowedTypes?.includes("*") ? void 0 : allowedTypes;
      }
      return {
        per_page: view.perPage || 20,
        page: view.page || 1,
        status: "inherit",
        order: view.sort?.direction,
        orderby: view.sort?.field,
        search: view.search,
        _embed: "author,wp:attached-to",
        ...filters
      };
    }, [view, allowedTypes]);
    const {
      records: mediaRecords,
      isResolving: isLoading,
      totalItems,
      totalPages
    } = useEntityRecordsWithPermissions("postType", "attachment", queryArgs);
    const fields = (0, import_element7.useMemo)(
      () => [
        // Media field definitions from @wordpress/media-fields
        // Cast is safe because RestAttachment has the same properties as Attachment
        {
          ...media_thumbnail_default,
          enableHiding: false
          // Within the modal, the thumbnail should always be shown.
        },
        {
          id: "title",
          type: "text",
          label: (0, import_i18n23.__)("Title"),
          getValue: ({ item }) => {
            const titleValue = item.title.raw || item.title.rendered;
            return titleValue || (0, import_i18n23.__)("(no title)");
          }
        },
        alt_text_default,
        caption_default,
        description_default,
        date_added_default,
        date_modified_default,
        author_default,
        filename_default,
        filesize_default,
        media_dimensions_default,
        mime_type_default,
        attached_to_default
      ],
      []
    );
    const actions = (0, import_element7.useMemo)(
      () => [
        {
          id: "select",
          label: multiple ? (0, import_i18n23.__)("Select") : (0, import_i18n23.__)("Select"),
          isPrimary: true,
          supportsBulk: multiple,
          async callback() {
            if (selection.length === 0) {
              return;
            }
            const selectedPostsQuery = {
              include: selection,
              per_page: -1
            };
            const selectedPosts = await (0, import_data4.resolveSelect)(
              import_core_data4.store
            ).getEntityRecords(
              "postType",
              "attachment",
              selectedPostsQuery
            );
            const transformedPosts = (selectedPosts ?? []).map(transformAttachment).filter(Boolean);
            const selectedItems = multiple ? transformedPosts : transformedPosts?.[0];
            onSelect(selectedItems);
          }
        }
      ],
      [multiple, onSelect, selection]
    );
    const handleModalClose = (0, import_element7.useCallback)(() => {
      onClose?.();
    }, [onClose]);
    const handleUpload = onUpload || uploadMedia;
    const handleUploadComplete = (0, import_element7.useCallback)(
      (attachments) => {
        const allComplete = attachments.every(
          (attachment) => attachment.id && attachment.url && !(0, import_blob2.isBlobURL)(attachment.url)
        );
        if (allComplete && attachments.length > 0) {
          createSuccessNotice(
            (0, import_i18n23.sprintf)(
              // translators: %s: number of files
              (0, import_i18n23._n)(
                "Uploaded %s file",
                "Uploaded %s files",
                attachments.length
              ),
              attachments.length.toLocaleString()
            ),
            {
              type: "snackbar",
              context: NOTICES_CONTEXT,
              id: NOTICE_ID_UPLOAD_PROGRESS
            }
          );
          const uploadedIds = attachments.map((attachment) => String(attachment.id)).filter(Boolean);
          if (multiple) {
            setSelection((prev) => [...prev, ...uploadedIds]);
          } else {
            setSelection(uploadedIds.slice(0, 1));
          }
          invalidateResolution("getEntityRecords", [
            "postType",
            "attachment",
            queryArgs
          ]);
        }
      },
      [createSuccessNotice, invalidateResolution, queryArgs, multiple]
    );
    const handleUploadError = (0, import_element7.useCallback)(
      (error) => {
        createErrorNotice(error.message, {
          type: "snackbar",
          context: NOTICES_CONTEXT,
          id: NOTICE_ID_UPLOAD_PROGRESS
        });
      },
      [createErrorNotice]
    );
    const handleFileSelect = (0, import_element7.useCallback)(
      (event) => {
        const files = event.target.files;
        if (files && files.length > 0) {
          const filesArray = Array.from(files);
          createInfoNotice(
            (0, import_i18n23.sprintf)(
              // translators: %s: number of files
              (0, import_i18n23._n)(
                "Uploading %s file",
                "Uploading %s files",
                filesArray.length
              ),
              filesArray.length.toLocaleString()
            ),
            {
              type: "snackbar",
              context: NOTICES_CONTEXT,
              id: NOTICE_ID_UPLOAD_PROGRESS,
              explicitDismiss: true
            }
          );
          handleUpload({
            allowedTypes,
            filesList: filesArray,
            onFileChange: handleUploadComplete,
            onError: handleUploadError
          });
        }
      },
      [
        allowedTypes,
        handleUpload,
        createInfoNotice,
        handleUploadComplete,
        handleUploadError
      ]
    );
    const paginationInfo = (0, import_element7.useMemo)(
      () => ({
        totalItems,
        totalPages
      }),
      [totalItems, totalPages]
    );
    const defaultLayouts = (0, import_element7.useMemo)(
      () => ({
        [LAYOUT_PICKER_GRID]: {
          fields: [],
          showTitle: false
        },
        [LAYOUT_PICKER_TABLE]: {
          fields: [
            "filename",
            "filesize",
            "media_dimensions",
            "author",
            "date"
          ],
          showTitle: true
        }
      }),
      []
    );
    const acceptTypes = (0, import_element7.useMemo)(() => {
      if (allowedTypes?.includes("*")) {
        return void 0;
      }
      return allowedTypes?.join(",");
    }, [allowedTypes]);
    if (!isOpen) {
      return null;
    }
    return /* @__PURE__ */ (0, import_jsx_runtime15.jsxs)(
      import_components8.Modal,
      {
        title,
        onRequestClose: handleModalClose,
        isDismissible,
        className: modalClass,
        overlayClassName: "media-upload-modal",
        size: "fill",
        headerActions: /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(
          import_components8.FormFileUpload,
          {
            accept: acceptTypes,
            multiple: true,
            onChange: handleFileSelect,
            __next40pxDefaultSize: true,
            render: ({ openFileDialog }) => /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(
              import_components8.Button,
              {
                onClick: openFileDialog,
                icon: upload_default,
                __next40pxDefaultSize: true,
                children: (0, import_i18n23.__)("Upload media")
              }
            )
          }
        ),
        children: [
          /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(
            import_components8.DropZone,
            {
              onFilesDrop: (files) => {
                let filteredFiles = files;
                if (allowedTypes && !allowedTypes.includes("*")) {
                  filteredFiles = files.filter(
                    (file) => allowedTypes.some((allowedType) => {
                      return file.type === allowedType || file.type.startsWith(
                        allowedType.replace("*", "")
                      );
                    })
                  );
                }
                if (filteredFiles.length > 0) {
                  createInfoNotice(
                    (0, import_i18n23.sprintf)(
                      // translators: %s: number of files
                      (0, import_i18n23._n)(
                        "Uploading %s file",
                        "Uploading %s files",
                        filteredFiles.length
                      ),
                      filteredFiles.length.toLocaleString()
                    ),
                    {
                      type: "snackbar",
                      context: NOTICES_CONTEXT,
                      id: NOTICE_ID_UPLOAD_PROGRESS,
                      explicitDismiss: true
                    }
                  );
                  handleUpload({
                    allowedTypes,
                    filesList: filteredFiles,
                    onFileChange: handleUploadComplete,
                    onError: handleUploadError
                  });
                }
              },
              label: (0, import_i18n23.__)("Drop files to upload")
            }
          ),
          /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(
            import_dataviews.DataViewsPicker,
            {
              data: mediaRecords || [],
              fields,
              view,
              onChangeView: setView,
              actions,
              selection,
              onChangeSelection: setSelection,
              isLoading,
              paginationInfo,
              defaultLayouts,
              getItemId: (item) => String(item.id),
              search,
              searchLabel,
              itemListLabel: (0, import_i18n23.__)("Media items")
            }
          ),
          /* @__PURE__ */ (0, import_jsx_runtime15.jsx)(
            import_notices.SnackbarNotices,
            {
              className: "media-upload-modal__snackbar",
              context: NOTICES_CONTEXT
            }
          )
        ]
      }
    );
  }

  // packages/media-utils/build-module/private-apis.mjs
  var privateApis = {};
  lock(privateApis, {
    sideloadMedia,
    MediaUploadModal
  });
  return __toCommonJS(index_exports);
})();
//# sourceMappingURL=index.js.map
