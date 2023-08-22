import './bootstrap';
import Alpine from 'alpinejs'

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginFileValidateType);

window.Alpine = Alpine
window.FilePond = FilePond

Alpine.start()
