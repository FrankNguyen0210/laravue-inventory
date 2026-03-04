<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

// Tạo một biến phản hồi (reactive) để chứa danh sách sản phẩm
const products = ref([])
const loading = ref(true)

const fetchProducts = async () => {
  try {
    // Gọi API từ Laravel
    const response = await axios.get('http://127.0.0.1:8000/api/products')
    products.value = response.data
  } catch (error) {
    console.error("Lỗi khi lấy dữ liệu:", error)
    alert("Không thể kết nối với Backend. Kiểm tra lại XAMPP và php artisan serve!")
  } finally {
    loading.value = false
  }
}

// Hàm này tự chạy khi trang web vừa tải xong
onMounted(() => {
  fetchProducts()
})
</script>

<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto">
      <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
          <span class="text-4xl">📦</span> Quản lý kho hàng
        </h1>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
          + Thêm sản phẩm
        </button>
      </div>

      <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
              <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">ID</th>
              <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase">Sản phẩm</th>
              <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">SKU</th>
              <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-right">Giá bán</th>
              <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase text-center">Tồn kho</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="product in products" :key="product.id" class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-500 font-mono text-sm">#{{ product.id }}</td>
              <td class="px-6 py-4">
                <div class="font-medium text-gray-900">{{ product.name }}</div>
                <div class="text-xs text-gray-400">Thiết bị điện tử</div>
              </td>
              <td class="px-6 py-4 text-center">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold italic">
                  {{ product.sku }}
                </span>
              </td>
              <td class="px-6 py-4 text-right font-semibold text-blue-600">
                {{ Number(product.price).toLocaleString() }}đ
              </td>
              <td class="px-6 py-4 text-center">
                <span :class="product.stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" 
                      class="px-3 py-1 rounded-full text-xs font-medium">
                  {{ product.stock }} máy
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>