import Alpine from 'alpinejs'
import persist from "@alpinejs/persist";
import collapse from "@alpinejs/collapse";
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'

Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

Alpine.plugin(persist);
Alpine.plugin(collapse);

window.Alpine = Alpine

Alpine.start()
