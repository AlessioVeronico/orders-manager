<template>
    <div id="app">
      <header>
        <h1>Orders Manager</h1>
        <nav>
          <router-link to="/" class="nav-link">Home</router-link>
          <router-link to="/orders" class="nav-link">Orders</router-link>
          <router-link to="/products" class="nav-link">Products</router-link>
        </nav>
      </header>
      <main>
        <router-view></router-view>
      </main>
      <footer>
        <p>&copy; 2024 Order Manager. All rights reserved.</p>
      </footer>
    </div>
  </template>
  
  <script setup>
  // No specific logic needed here
  </script>
  
  <style scoped>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 30px;
  }
  
  header {
    background-color: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #e7e7e7;
  }
  
  nav {
    margin: 20px 0;
  }
  
  .nav-link {
    margin: 0 15px;
    text-decoration: none;
    color: #007bff;
  }
  
  .nav-link:hover {
    text-decoration: underline;
  }
  
  footer {
    margin-top: 30px;
    padding: 20px;
    border-top: 1px solid #e7e7e7;
  }
</style>
  