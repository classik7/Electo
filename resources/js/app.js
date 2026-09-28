import './bootstrap';

import '../css/app.css';

import Alpine from 'alpinejs';
import { Passkeys } from '@laravel/passkeys';

window.Alpine = Alpine;
window.Passkeys = Passkeys;

Alpine.start();