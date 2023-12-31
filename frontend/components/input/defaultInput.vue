<template>
  <div
    :class="{
      default_input__active: !!modelValue,
      default_input_disabled: disabled,
    }"
    class="default_input_block"
  >
    <span v-if="title" class="default_input_title">
      {{ placeholder }}
    </span>
    <div class="default_input_container"></div>
    <input
        v-if='!mask'
      @focus="$emit('focus')"
      @blur="$emit('blur')"
      @input="$emit('update:modelValue', $event.target.value)"
      :readonly="readonly"
      :placeholder="!title ? placeholder : null"
      :disabled="disabled"
      :value="modelValue"
      v-bind:class="`default_input ${title ? 'default_input_with_title' : ''}`"
      type="text"
    />
    <input
      v-if='mask'
      @focus="$emit('focus')"
      @blur="$emit('blur')"
      v-bind:readonly="readonly"
      v-bind:placeholder="!title ? placeholder : null"
      v-bind:disabled="disabled"
      v-bind:value="modelValue"
      v-bind:class="`default_input ${title ? 'default_input_with_title' : ''}`"
      v-bind:data-maska="mask"
      v-maska="bindedObject"
      data-maska-eager
      type="text"
    />
    <div class="container_right_slot">
      <slot name="container-right" />
    </div>
    <div
      v-if="modelValue && clearButton"
      @click="updateValueInput('')"
      class="default_input_clear_button_block"
    >
      <img
        class="default_input_clear"
        src="@/assets/images/icons/arrow_done.svg"
        alt=""
      />
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { vMaska } from "maska"

export default {
  directives: { maska: vMaska },
  props: {
    disabled: {
      type: Boolean,
    },
    modelValue: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
    },
    title: {
      type: Boolean,
      default: false,
    },
    clearButton: {
      type: Boolean,
    },
    readonly: {
      type: Boolean,
    },
    mask: {
      type: String,
      default: undefined,
    },
  },
  data() {
    return {
      valueInput: '',
      bindedObject: {
        masked: '',
        unmasked: '',
        completed: false,
      },
    };
  },
  methods: {
    updateValueInput(value) {
      this.valueInput = value;
    },
  },
  created() {
    if (this.mask) {
      this.$watch('bindedObject.masked', (masked) => {
        this.$emit('update:modelValue', masked);
      });
    }
  },
};
</script>

<style scoped>
.default_input_block {
  /* height: 100%; */
  width: 100%;
  border: 1px solid #e4e6e7;
  border-radius: 3px;
  display: flex;
  align-items: center;
  position: relative;
  background: white;
}

.default_input_block:focus-within {
  border: 1px solid #48538b;
}

.default_input_block:focus-within .default_input_title {
  top: -22%;
  font-size: 10px;
}

.default_input_block:hover {
  border: 1px solid #aaaaaa;
}

.default_input_block:disabled:has(.default_input) {
  background: #000000;
}

.default_input_disabled {
  background: #fafafa;
}

.default_input_disabled:hover {
  border: 1px solid #e4e6e7;
}
.default_input {
  width: 100%;
  border: none;
  outline: none;
  height: 100%;
  background: none;
  padding: 16px 16px;
  z-index: 10;
}
.default_input_with_title {
  padding: 20px 16px 8px;
}
.default_input_title {
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  transition: 0.2s;
  display: flex;
  align-items: center;
  padding-left: 16px;
  color: #AAAAAA;
}

.container_right_slot {
  padding-right: 10px;
}

.default_input__active {
  background: #ffffff;
  border: 1px solid #e4e6e7;
}

.default_input__active .default_input {
  color: #2b2b2b;
}

.default_input__active:focus-within {
  background: #ffffff;
  border: 1px solid #e4e6e7 !important;
  box-shadow: 0px 0px 12px rgba(95, 124, 151, 0.25);
}

.default_input__active .default_input_title {
  top: -22%;
  font-size: 10px;
}

.default_input__active:focus-within .default_input {
  color: #2b2b2b;
}

.default_input_clear_button {
  width: 12px;
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
}

.default_input_clear_button_block {
  padding: 0 10px;
}
</style>
