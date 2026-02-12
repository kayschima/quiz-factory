<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/layouts/MainLayout.vue';
</script>

<template>
    <Head title="Datenschutz" />
    <MainLayout>
        <div class="mx-auto max-w-3xl text-left">
            <h1 class="mb-6 text-3xl font-semibold">Datenschutzerklärung</h1>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold">1. Verantwortlicher</h2>
                <p class="text-muted-foreground">
                    Verantwortlicher im Sinne der DSGVO ist:
                    <br />
                    <strong>Kay Markschies</strong>
                    <br />
                    24568 Kaltenkirchen
                    <br />
                    Deutschland
                </p>
                <p class="text-muted-foreground">
                    Kontakt: <strong>kayschima@web.de</strong>
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    2. Datenschutzbeauftragter
                </h2>
                <p class="text-muted-foreground">
                    Ein Datenschutzbeauftragter ist nicht bestellt, sofern keine
                    gesetzliche Verpflichtung hierzu besteht.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    3. Zwecke und Rechtsgrundlagen
                </h2>
                <p class="text-muted-foreground">
                    Wir verarbeiten personenbezogene Daten nur, soweit dies
                    erforderlich ist, insbesondere auf folgenden
                    Rechtsgrundlagen:
                </p>
                <ul class="list-disc space-y-2 pl-5 text-muted-foreground">
                    <li>
                        Art. 6 Abs. 1 lit. b DSGVO (Vertrag/vertragsähnliche
                        Maßnahmen) für Registrierung, Login und Nutzung der App.
                    </li>
                    <li>
                        Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse) für
                        den sicheren Betrieb, Fehleranalyse und
                        Missbrauchsvermeidung.
                    </li>
                    <li>
                        Art. 6 Abs. 1 lit. c DSGVO, sofern eine rechtliche
                        Verpflichtung besteht.
                    </li>
                </ul>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    4. Datenverarbeitung im Detail
                </h2>

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">a) Server-Logfiles</h3>
                    <p class="text-muted-foreground">
                        Beim Aufruf der App werden technisch notwendige Daten
                        verarbeitet, z. B. IP-Adresse, Datum/Uhrzeit,
                        aufgerufene Seiten, HTTP-Status, User-Agent. Die
                        Verarbeitung dient der Stabilität und Sicherheit.
                    </p>
                    <p class="text-muted-foreground">
                        Speicherdauer: <strong>30 Tage</strong>.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">
                        b) Session- und Sicherheits-Cookies
                    </h3>
                    <p class="text-muted-foreground">
                        Für die Anmeldung und den sicheren Betrieb werden
                        technisch notwendige Cookies (z. B. Session- und
                        CSRF-Cookies) eingesetzt. Diese sind für den Betrieb
                        erforderlich und werden nach Ende der Sitzung oder nach
                        einer definierten Zeit automatisch gelöscht.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">
                        c) Registrierung und Konto
                    </h3>
                    <p class="text-muted-foreground">
                        Bei der Registrierung verarbeiten wir Ihre Angaben (z.
                        B. Name, E-Mail, Passwort-Hash). Diese Daten benötigen
                        wir zur Kontoerstellung, Authentifizierung und
                        Verwaltung des Nutzerkontos.
                    </p>
                    <p class="text-muted-foreground">
                        Speicherdauer: bis zur Löschung des Kontos oder sofern
                        gesetzliche Aufbewahrungspflichten bestehen.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">d) Quiz-Teilnahme</h3>
                    <p class="text-muted-foreground">
                        Bei der Teilnahme am Quiz verarbeiten wir Ihre Eingaben
                        (z. B. Antworten und ggf. Punktestand), um das Quiz
                        bereitzustellen und Ergebnisse anzuzeigen.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">e) Fragen einreichen</h3>
                    <p class="text-muted-foreground">
                        Wenn Sie neue Fragen einreichen, verarbeiten wir die
                        übermittelten Inhalte sowie ggf. die Zuordnung zu Ihrem
                        Nutzerkonto, um die Einreichung zu prüfen und zu
                        veröffentlichen.
                    </p>
                </div>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    5. Empfänger und Auftragsverarbeiter
                </h2>
                <p class="text-muted-foreground">
                    Wir setzen Dienstleister für Hosting und Wartung ein, die
                    als Auftragsverarbeiter tätig sind und nur nach unseren
                    Weisungen handeln.
                </p>
                <p class="text-muted-foreground">
                    Hosting-Anbieter:
                    <strong>[Anbieter, Anschrift, Land]</strong>
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">6. Drittlandübermittlung</h2>
                <p class="text-muted-foreground">
                    Eine Übermittlung in Drittländer außerhalb der EU/EWR findet
                    nur statt, wenn dies für den Betrieb erforderlich ist und
                    geeignete Garantien vorliegen (z. B.
                    EU-Standardvertragsklauseln).
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">7. Ihre Rechte</h2>
                <ul class="list-disc space-y-2 pl-5 text-muted-foreground">
                    <li>Auskunft (Art. 15 DSGVO)</li>
                    <li>Berichtigung (Art. 16 DSGVO)</li>
                    <li>Löschung (Art. 17 DSGVO)</li>
                    <li>Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
                    <li>Datenübertragbarkeit (Art. 20 DSGVO)</li>
                    <li>Widerspruch gegen Verarbeitung (Art. 21 DSGVO)</li>
                </ul>
                <p class="text-muted-foreground">
                    Zur Ausübung Ihrer Rechte genügt eine Nachricht an die oben
                    genannte Kontaktadresse.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">8. Beschwerderecht</h2>
                <p class="text-muted-foreground">
                    Sie haben das Recht, sich bei einer
                    Datenschutzaufsichtsbehörde zu beschweren. Zuständig ist die
                    Aufsichtsbehörde Ihres gewöhnlichen Aufenthalts oder unseres
                    Sitzes.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    9. Pflicht zur Bereitstellung
                </h2>
                <p class="text-muted-foreground">
                    Die Bereitstellung der Daten ist für die Nutzung der App
                    erforderlich. Ohne die erforderlichen Angaben ist eine
                    Registrierung und Nutzung nicht möglich.
                </p>
            </section>

            <section class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold">
                    10. Stand dieser Erklärung
                </h2>
                <p class="text-muted-foreground">
                    Stand: <strong>12. Februar 2026</strong>.
                </p>
            </section>
        </div>
    </MainLayout>
</template>
