const pageTitle = document.querySelector('title')
const sidebar = document.getElementById('sidebar')
const sidebarLogo = document.getElementById('sidebar-logo')
const sidebarItems = document.querySelectorAll('#sidebar ul li')
const sidebarItemsLinks = document.querySelectorAll('#sidebar ul li a')
const toggleSidebar = document.querySelectorAll('.toggle-mobile-sidebar')
const sidebarText = document.querySelectorAll('.collapsable-text')
const mobileSidebarMask = document.querySelector('.sidebar-mobile-mask')
const collapseSidebar = document.getElementById('collapse-side-bar')
const uncollapseSidebar = document.getElementById('uncollapse-side-bar')
const logoutButton = document.getElementById('logout-button')

const toggleMaskStyles = () => {
  if (mobileSidebarMask.classList.contains('hidden')) {
    mobileSidebarMask.classList.toggle('hidden')
    setTimeout(() => {
      mobileSidebarMask.classList.toggle('opacity-0')
    }, 0)
  } else {
    setTimeout(() => {
      mobileSidebarMask.classList.toggle('hidden')
    }, 150)
    mobileSidebarMask.classList.toggle('opacity-0')
  }
}

const collapseSidebarFunction = () => {
  sidebarText.forEach((element) => {
    element.classList.toggle('lg:hidden')
  })

  collapseSidebar.classList.toggle('hidden')

  if (!uncollapseSidebar.classList.contains('hidden')) {
    uncollapseSidebar.classList.toggle('hidden')
  }

  sidebarItemsLinks.forEach((element) => {
    element.classList.toggle('lg:justify-center')
  })

  logoutButton.classList.toggle('lg:justify-center')

  sidebar.classList.toggle('lg:w-fit')
}

uncollapseSidebar.addEventListener('click', collapseSidebarFunction)

collapseSidebar.addEventListener('click', collapseSidebarFunction)

// sidebarLogo.addEventListener('mouseover', () => {
//   sidebarLogo.classList.toggle('hidden')
//   if (sidebar.classList.contains('w-fit-important')) {
//     uncollapseSidebar.classList.toggle('hidden')
//   } else {
//     collapseSidebar.classList.toggle('hidden')
//   }
// })

// sidebarLogo.addEventListener('mouseout', () => {
//   sidebarLogo.classList.toggle('hidden')
// })

mobileSidebarMask.addEventListener('click', () => {
  document.getElementById('sidebar').classList.toggle('translate-x-full')

  toggleMaskStyles()
})

toggleSidebar.forEach((element) => {
  element.addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('translate-x-full')

    toggleMaskStyles()
  })
})

sidebarItemsLinks.forEach((link, index) => {
  if (link.innerText === pageTitle.innerText) {
    sidebarItems[index].classList.add('bg-[var(--sidebar-item-focus)]')
  } else if (
    sidebarItems[index].classList.contains('bg-[var(--sidebar-item-focus)]')
  ) {
    sidebarItems[index].classList.remove('bg-[var(--sidebar-item-focus)]')
  }
})
