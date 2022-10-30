<template>
  <input
    :value="modelValue"
    :placeholder="hint"
    @input="sendEmit"
    :type="type"
    :name="name"
    required
    class="
      w-60
      bg-gray-100
      p-1
      border-2 border-gray-200
      rounded
      text-sm
      placeholder:text-xs placeholder:text-gray-400
      outline-2 outline-blue-500/50
    "
  />
</template>

<script>
export default {
  name: "AppInput",
  methods: {
    sendEmit(event){
      this.$emit('update:modelValue', event.target.value)
    }
  },
  props: {
    modelValue: String,
    type: String,
    hint: String,
    name: String
  },
};
</script>