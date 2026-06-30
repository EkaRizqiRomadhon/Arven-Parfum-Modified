// =========================================
// CONFIG & UTILS
// =========================================
const STORAGE_KEY = 'arven_cart_v1';

// Format Rupiah: Rp 1.000.000
const currency = (n) => {
  return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
};

// =========================================
// DATA MANAGEMENT
// =========================================
function readCart() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    return raw ? JSON.parse(raw) : [];
  } catch (e) {
    return [];
  }
}

function writeCart(cart) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
  renderCart();
  updateBadge();
}

function getCartCount() {
  return readCart().reduce((s, i) => s + (i.qty || 0), 0);
}

// =========================================
// ACTIONS (Global Functions for HTML onClick)
// =========================================

// Tambah/Kurang jumlah item
window.changeQty = function(id, delta) {
  const cart = readCart();
  const idx = cart.findIndex(i => i.id == id);
  if (idx >= 0) {
    const newQty = (cart[idx].qty || 1) + delta;
    if (cart[idx].stock !== undefined && newQty > cart[idx].stock) {
        showToast('Jumlah melebihi stok yang tersedia.', 'error', 'Stok Terbatas');
        return;
    }
    cart[idx].qty = Math.max(1, newQty);
    writeCart(cart);
  }
};

// Hapus item spesifik
window.removeItem = function(id) {
  const cart = readCart().filter(i => i.id != id);
  writeCart(cart);
};

// Kosongkan seluruh keranjang
function clearCart() {
  localStorage.removeItem(STORAGE_KEY);
  renderCart();
  updateBadge();
}

// =========================================
// UI UPDATES
// =========================================

function updateBadge() {
  const count = getCartCount();
  const badge = document.getElementById('cartBadge');
  
  if (badge) {
    if (count > 0) {
      badge.style.display = 'flex';
      badge.textContent = count;
    } else {
      badge.style.display = 'none';
    }
  }
}

function renderCart() {
  const container = document.getElementById('cartList');
  if (!container) return;

  const cart = readCart();

  // 1. Handle Kosong
  if (!cart.length) {
    container.innerHTML = `
      <div class="empty-state">
        <h3 style="color:#fff; margin-bottom:10px;">Keranjang Anda Kosong</h3>
        <p>Temukan koleksi eksklusif kami sekarang.</p>
        <a href="/koleksi" class="btn btn-primary" style="display:inline-block; width:auto; margin-top:20px; padding:10px 30px;">Belanja Sekarang</a>
      </div>`;
    
    // Reset Summary
    updateSummary(0);
    return;
  }

  // 2. Render Items
  container.innerHTML = cart.map(item => {
    const subtotal = item.price * item.qty;
    // Gunakan escape untuk mencegah XSS jika nama produk aneh
    const safeName = item.name.replace(/"/g, '&quot;'); 

    return `
      <div class="cart-item">
        <div class="item-thumb">
          ${item.image ? `<img src="${item.image}" alt="${safeName}">` : ''}
        </div>
        
        <div class="item-info">
          <h3>${safeName}</h3>
          <div class="price-row">
            ${currency(item.price)}
          </div>
          
          <div class="qty-controls">
            <button onclick="changeQty('${item.id}', -1)">−</button>
            <span class="qty-value">${item.qty}</span>
            <button onclick="changeQty('${item.id}', 1)">+</button>
          </div>
        </div>

        <div class="item-remove" style="text-align:right">
          <button class="remove-btn" onclick="removeItem('${item.id}')" title="Hapus">✕</button>
          <div class="subtotal" style="margin-top:20px;">${currency(subtotal)}</div>
        </div>
      </div>
    `;
  }).join('');

  // 3. Update Summary
  const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
  updateSummary(subtotal);
}

function updateSummary(subtotal) {
  const tax = subtotal * 0.0; // Pajak 0% (ubah jika perlu)
  const total = subtotal + tax;

  const elSub = document.getElementById('subtotalText');
  const elTax = document.getElementById('taxText');
  const elTot = document.getElementById('totalText');

  if(elSub) elSub.textContent = currency(subtotal);
  if(elTax) elTax.textContent = currency(tax);
  if(elTot) elTot.textContent = currency(total);
}

// =========================================
// INITIALIZATION & LISTENERS
// =========================================

document.addEventListener('DOMContentLoaded', () => {
  // Render awal
  renderCart();
  updateBadge();

  // 1. Header Scroll Effect
  window.addEventListener("scroll", function() {
    const header = document.getElementById("siteHeader");
    if (header) {
      if (window.scrollY > 50) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    }
  });

  // 2. Button Listeners
  const clearBtn = document.getElementById('clearBtn');
  const clearCartModal  = document.getElementById('clearCartModal');
  const clearCartConfirm = document.getElementById('clearCartConfirm');
  const clearCartCancel  = document.getElementById('clearCartCancel');

  if (clearBtn && clearCartModal) {
    // Buka modal saat tombol "Kosongkan Keranjang" diklik
    clearBtn.addEventListener('click', () => {
      if (readCart().length === 0) {
        showToast('Keranjang sudah kosong, tidak ada yang perlu dihapus.', 'info', 'Keranjang Kosong');
        return;
      }
      clearCartModal.style.display = 'flex';
    });

    // Konfirmasi: kosongkan dan tutup modal
    clearCartConfirm.addEventListener('click', () => {
      clearCart();
      clearCartModal.style.display = 'none';
      showToast('Keranjang berhasil dikosongkan.', 'success', 'Keranjang Kosong');
    });

    // Batal: tutup saja modalnya
    clearCartCancel.addEventListener('click', () => {
      clearCartModal.style.display = 'none';
    });

    // Klik backdrop (luar modal) juga menutup modal
    clearCartModal.addEventListener('click', (e) => {
      if (e.target === clearCartModal) clearCartModal.style.display = 'none';
    });
  }

  const checkoutBtn = document.getElementById('checkoutBtn');
  const modal = document.getElementById('paymentModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  
  if (checkoutBtn && modal) {
    checkoutBtn.addEventListener('click', () => {
       const isAuth = document.querySelector('meta[name="auth-check"]')?.getAttribute('content') === 'true';
       if (!isAuth) {
           showToast('Silakan login terlebih dahulu untuk melanjutkan checkout.', 'info', 'Login Diperlukan');
           setTimeout(() => window.location.href = '/login', 1800);
           return;
       }

       const cart = readCart();
       if(cart.length === 0) {
           showToast('Keranjang Anda masih kosong.', 'error', 'Keranjang Kosong');
           return;
       }

       // Hitung total
       const subtotal = cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
       document.getElementById('modalTotalText').textContent = currency(subtotal);
       document.getElementById('modalOrderIdText').textContent = '—';

       // Tampilkan modal dulu, lalu buat order
       modal.style.display = 'flex';
       checkoutBtn.disabled = true;
       checkoutBtn.textContent = 'Memproses...';

       // Buat order (status: pending)
       fetch('/checkout/process', {
           method: 'POST',
           headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
               'Accept': 'application/json'
           },
           body: JSON.stringify({ cart: cart })
       })
       .then(res => res.json())
       .then(data => {
           checkoutBtn.disabled = false;
           checkoutBtn.textContent = 'Secure Checkout';

           if (!data.success) {
               modal.style.display = 'none';
               showToast('Gagal membuat pesanan. Silakan coba lagi.', 'error', 'Error');
               return;
           }

           // Simpan orderId ke global agar processSimulatedPayment bisa pakai
           window._pendingOrderId = data.orderId;
           document.getElementById('modalOrderIdText').textContent = '#' + data.orderId;
       })
       .catch(err => {
           checkoutBtn.disabled = false;
           checkoutBtn.textContent = 'Secure Checkout';
           modal.style.display = 'none';
           showToast('Terjadi kesalahan koneksi.', 'error', 'Error');
       });
    });
    
    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        // Reset state
        window._pendingOrderId = null;
        document.getElementById('paymentMethodsView').style.display = 'block';
        document.getElementById('paymentLoadingView').style.display = 'none';
        document.getElementById('paymentSuccessView').style.display = 'none';
        document.getElementById('closeModalBtn').style.display = 'block';
        document.querySelectorAll('.pay-method-btn').forEach(btn => {
            btn.style.pointerEvents = 'auto';
            btn.style.opacity = '1';
        });
    });
  }

  // ─── PAYMENT SIMULATOR ────────────────────────────────────────────────────
  // Dipanggil dari onclick tombol metode di cart.blade.php
  window.processSimulatedPayment = function(method) {
    if (!window._pendingOrderId) {
      showToast('Order belum siap. Silakan tutup dan coba lagi.', 'error', 'Error');
      return;
    }

    const orderId = window._pendingOrderId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Disable semua tombol metode
    document.querySelectorAll('.pay-method-btn').forEach(btn => {
      btn.style.pointerEvents = 'none';
      btn.style.opacity = '0.5';
    });

    // Pindah ke view loading
    document.getElementById('paymentMethodsView').style.display = 'none';
    document.getElementById('paymentLoadingView').style.display = 'block';

    // STEP 1: pending → processing
    fetch(`/payment/${orderId}/process`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify({ method: method })
    })
    .then(() => {
      // STEP 2: delay 3 detik (simulasi waktu verifikasi bank)
      return new Promise(resolve => setTimeout(resolve, 3000));
    })
    .then(() => {
      // STEP 3: processing → paid
      return fetch(`/payment/${orderId}/status`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ status: 'paid' })
      }).then(res => res.json());
    })
    .then(res => {
      if (res.success) {
        // Kosongkan keranjang lokal
        clearCart();

        // Tampilkan success screen
        document.getElementById('paymentLoadingView').style.display = 'none';
        document.getElementById('paymentSuccessView').style.display = 'block';
        document.getElementById('closeModalBtn').style.display = 'none';

        // Isi detail sukses
        document.getElementById('successOrderId').textContent  = '#' + orderId;
        document.getElementById('successTotal').textContent    = document.getElementById('modalTotalText').textContent;
        document.getElementById('successMethod').textContent   = method;

        showToast(`Pembayaran via ${method} berhasil!`, 'success', 'Checkout Berhasil');
      }
    })
    .catch(err => {
      console.error('Payment error:', err);
      showToast('Terjadi kesalahan saat memproses pembayaran.', 'error', 'Error');

      // Kembalikan ke pilihan metode
      document.getElementById('paymentMethodsView').style.display = 'block';
      document.getElementById('paymentLoadingView').style.display = 'none';
      document.querySelectorAll('.pay-method-btn').forEach(btn => {
        btn.style.pointerEvents = 'auto';
        btn.style.opacity = '1';
      });
    });
  };

  // ─── ADD TO CART (dari halaman brand) ─────────────────────────────────────
  window.addToCart = function(id, name, price, image, stock) {
    stock = parseInt(stock) || 0;
    const cart = readCart();
    const existing = cart.find(i => i.id === id);
    if (existing) {
      if (existing.qty + 1 > stock) {
          showToast(`Maaf, stok ${name} tidak mencukupi.`, 'error', 'Stok Terbatas');
          return;
      }
      existing.qty += 1;
      existing.stock = stock;
      showToast(`Jumlah ${name} diperbarui di keranjang.`, 'success', 'Keranjang Diperbarui');
    } else {
      if (stock < 1) {
          showToast(`Maaf, stok ${name} habis.`, 'error', 'Stok Habis');
          return;
      }
      cart.push({ id, name, price: parseInt(price), image, qty: 1, stock: stock });
      showToast(`${name} berhasil ditambahkan ke keranjang.`, 'success', 'Ditambahkan');
    }
    writeCart(cart);
  };

  const addToCartBtns = document.querySelectorAll('.add-to-cart');
  addToCartBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const id    = this.dataset.id;
      const name  = this.dataset.name;
      const price = this.dataset.price;
      const img   = this.dataset.img;
      const stock = this.dataset.stock;
      window.addToCart(id, name, price, img, stock);
    });
  });
});