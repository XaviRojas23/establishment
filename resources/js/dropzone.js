import axios from "axios";

document.addEventListener('DOMContentLoaded', () => {


    if (document.querySelector('#dropzone')) {
        Dropzone.autoDiscover = false;


        const dropzone = new Dropzone('#dropzone', {
            url: '/images/store',
            dictDefaultMessage: 'Sube hasta 10 imágenes',
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar image",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            init: function() {
                const galery = document.querySelectorAll('.galery');

                if (galery.length > 0) {
                    galery.forEach(image => {
                        const imagePublicada = {};
                        imagePublicada.size = 1;
                        imagePublicada.name = image.value;
                        imagePublicada.nameServidor = image.value;

                        this.options.addedfile.call(this, imagePublicada);
                        this.options.thumbnail.call(this, imagePublicada, `/storage/${imagePublicada.name}`);

                        imagePublicada.previewElement.classList.add('dz-success');
                        imagePublicada.previewElement.classList.add('dz-complete');


                    })
                }
            },
            success: function(file, response) {
                console.log(file);
                console.log(response);
                file.nameServidor = response.file;
            },
            sending: function(file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value)
                console.log('enviando');
            },
            removedfile: function(file, response) {
                console.log(file);

                const params = {
                    image: file.nameServidor,
                    uuid: document.querySelector('#uuid').value
                }

                axios.post('/images/destroy', params)
                    .then(response => {
                        console.log(response)

                        // Eliminar del DOM
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
            }
        });
    }


})