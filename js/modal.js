const modalController = ({modal, btnOpen, btnClose, time = 300}) => {
  const modalElem = document.querySelector(modal);
  const buttonElems = document.querySelectorAll(btnOpen);

  if (!modalElem) {
      console.error(`Modal element with selector ${modal} not found.`);
      return;
  }

  modalElem.style.cssText = `
    display: flex;
    visibility: hidden;
    opacity: 0;
    transition: opacity ${time}ms ease-in-out;
  `;

  const closeModal = event => {
    const target = event.target;

    if (
      target === modalElem ||
      (btnClose && (target.closest && target.closest(btnClose))) ||
      event.code === 'Escape'
      ) {
      
      modalElem.style.opacity = 0;

      setTimeout(() => {
        modalElem.style.visibility = 'hidden';
      }, time);

      window.removeEventListener('keydown', closeModal);
    }
  }

  const openModal = () => {
    modalElem.style.visibility = 'visible';
    modalElem.style.opacity = 1;
    window.addEventListener('keydown', closeModal)
  };

  buttonElems.forEach(btn => {
    btn.addEventListener('click', openModal);
  });

  modalElem.addEventListener('click', closeModal);
};

document.addEventListener('DOMContentLoaded', function() {
  const menuCards = document.querySelectorAll('.menu_card');
  const modalTovar = document.getElementById('modal_tovar');
  const modalCloseBtn = document.querySelector('.modal__close');

  menuCards.forEach(card => {
      card.addEventListener('click', function(event) {
          if (!event.target.classList.contains('button_shop')) {
              const productInfo = {
                  name: this.querySelector('h3').textContent,
                  price: this.querySelector('.btn').textContent,
                  weight: this.querySelector('.weight').textContent,
                  image: this.querySelector('.banner-image img').src,
                  description: this.querySelector('p').textContent
              };

              const productContainer = document.createElement('div');
              productContainer.classList.add('product-container');

              const productImage = document.createElement('img');
              productImage.src = productInfo.image;

              const productDetails = document.createElement('div');
              productDetails.classList.add('product-details');

              const productName = document.createElement('h3');
              productName.textContent = productInfo.name;

              const productDescription = document.createElement('p');
              productDescription.textContent = 'Состав: ' + productInfo.description;

              const priceWeightContainer = document.createElement('div');
              priceWeightContainer.classList.add('price-weight-container');

              const productPrice = document.createElement('h5');
              productPrice.classList.add('product-price');
              productPrice.textContent = productInfo.price;

              const productWeight = document.createElement('h5');
              productWeight.classList.add('product-weight');
              productWeight.textContent = 'Вес: ' + productInfo.weight;

              priceWeightContainer.appendChild(productWeight);
              priceWeightContainer.appendChild(productPrice);

              productDetails.appendChild(productName);
              productDetails.appendChild(productDescription);
              productDetails.appendChild(priceWeightContainer);
              productContainer.appendChild(productImage);
              productContainer.appendChild(productDetails);

              modalTovar.innerHTML = '';

              const closeButton = document.createElement('button');
              closeButton.textContent = '✖';
              closeButton.classList.add('modal__close');

              closeButton.addEventListener('click', function() {
                  modalTovar.classList.remove('modal-open'); // Remove modal-open class after animation completes
              });

              modalTovar.appendChild(productContainer);
              modalTovar.appendChild(closeButton);

              modalTovar.classList.add('modal-open');
          }
      });
  });

  modalCloseBtn.addEventListener('click', function() {
      modalTovar.classList.remove('modal-open'); // Remove modal-open class after animation completes
  });

  

  // Обработчик события для удаления модального окна после завершения анимации
  modalTovar.addEventListener('animationend', function(event) {
      if (event.animationName === 'modalFadeOut') {
          modalTovar.style.display = 'none'; // Hide modal after animation completes
      }
  });
});

const modals = [
{
  modal: '.zakaz',
  btnOpen: '.corzina_open',
  btnClose: '.corzina__close',
},
{
  modal: '.modal1',
  btnOpen: '.komentariya_content',
  btnClose: '.modal__close',
},
{
  modal: '.modal_inter1',
  btnOpen: '.info_content_img1',
  btnClose: '.modal__close_img',
},
{
  modal: '.modal_inter2',
  btnOpen: '.info_content_img2',
  btnClose: '.modal__close_img',
},
{
  modal: '.modal_food1',
  btnOpen: '.info_content_img_food1',
  btnClose: '.modal__close_img',
},
{
  modal: '.modal_food2',
  btnOpen: '.info_content_img_food2',
  btnClose: '.modal__close_img',
},
{
  modal: '.modal_food3',
  btnOpen: '.info_content_img_food3',
  btnClose: '.modal__close_img',
},
{
  modal: '.modal_food4',
  btnOpen: '.info_content_img_food4',
  btnClose: '.modal__close_img',
}
];

modals.forEach(modalParams => {
modalController(modalParams);
});
