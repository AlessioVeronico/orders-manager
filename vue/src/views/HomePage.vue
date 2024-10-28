<script setup>
</script>
<template>
  <div class="home-container">
    <h1 class="welcome-message">Welcome to My App!</h1>
    <p class="description">Explore our features and manage your business easily.</p>      
  </div>
</template>

<style scoped>
.home-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /* height: 100vh; */
  text-align: center;
  background-color: #f0f4f8;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.welcome-message {
  font-size: 2.5em;
  margin-bottom: 10px;
  color: #333;
}

.description {
  font-size: 1.2em;
  margin-bottom: 20px;
  color: #666;
}
</style>