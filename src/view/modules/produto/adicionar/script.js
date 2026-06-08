const dismissErrorMessage = document.getElementById('dismissErrorMessage')

dismissErrorMessage?.addEventListener('click', () => {
  document.getElementById('errorMessage').classList.add('hidden')
})
