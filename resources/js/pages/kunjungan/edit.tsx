import KunjunganController from '@/actions/App/Http/Controllers/KunjunganController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Kunjungan, type MasterDokter, type MasterPenjamin, type MasterPoli, type Pasien } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';
import { format } from 'date-fns';

interface Props {
    kunjungan: Kunjungan;
    pasiens: Pasien[];
    dokters: MasterDokter[];
    polis: MasterPoli[];
    penjamins: MasterPenjamin[];
}

const breadcrumbs = (kunjungan: Kunjungan): BreadcrumbItem[] => [
    {
        title: 'Data Kunjungan',
        href: KunjunganController.index().url,
    },
    {
        title: 'Edit Kunjungan',
        href: KunjunganController.edit(kunjungan.id).url,
    },
];

export default function Edit({ kunjungan, pasiens, dokters, polis, penjamins }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs(kunjungan)}>
            <Head title="Edit Kunjungan" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Edit Data Kunjungan" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...KunjunganController.update.form(kunjungan.id)} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label>No. Registrasi</Label>
                                    <Input
                                        value={kunjungan.no_registrasi_kunjungan}
                                        disabled
                                        className="font-mono text-xs"
                                    />
                                    <p className="text-xs text-muted-foreground">
                                        Nomor registrasi tidak dapat diubah
                                    </p>
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="no_rm">
                                        Pasien <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="no_rm" defaultValue={kunjungan.no_rm} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih pasien" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {pasiens.map((pasien) => (
                                                <SelectItem key={pasien.id} value={pasien.no_rm}>
                                                    {pasien.no_rm} - {pasien.nama_pasien}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.no_rm} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="tanggal_kunjungan">
                                        Tanggal Kunjungan <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="tanggal_kunjungan"
                                        name="tanggal_kunjungan"
                                        type="date"
                                        defaultValue={format(new Date(kunjungan.tanggal_kunjungan), 'yyyy-MM-dd')}
                                        required
                                    />
                                    <InputError message={errors.tanggal_kunjungan} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="kode_dokter">
                                        Dokter <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="kode_dokter" defaultValue={kunjungan.kode_dokter.toString()} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih dokter" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {dokters.map((dokter) => (
                                                <SelectItem key={dokter.id} value={dokter.id.toString()}>
                                                    {dokter.kode_dokter} - {dokter.nama_dokter} ({dokter.spesialisasi})
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.kode_dokter} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="poli">
                                        Poli <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="poli" defaultValue={kunjungan.poli.toString()} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih poli" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {polis.map((poli) => (
                                                <SelectItem key={poli.id} value={poli.id.toString()}>
                                                    {poli.kode_poli} - {poli.nama_poli}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.poli} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="instalasi">
                                        Instalasi <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="instalasi" defaultValue={kunjungan.instalasi} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih instalasi" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="Rawat Jalan">Rawat Jalan</SelectItem>
                                            <SelectItem value="IGD">IGD</SelectItem>
                                            <SelectItem value="Rawat Inap">Rawat Inap</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.instalasi} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="penjamin_id">
                                        Penjamin <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="penjamin_id" defaultValue={kunjungan.penjamin_id.toString()} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih penjamin" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {penjamins.map((penjamin) => (
                                                <SelectItem key={penjamin.id} value={penjamin.id.toString()}>
                                                    {penjamin.kode_penjamin} - {penjamin.nama_penjamin} ({penjamin.jenis})
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.penjamin_id} />
                                </div>

                                <div className="flex justify-between">
                                    <Link href={KunjunganController.index().url}>
                                        <Button type="button" variant="outline">
                                            Kembali
                                        </Button>
                                    </Link>
                                    <Button type="submit" disabled={processing}>
                                        {processing ? 'Menyimpan...' : 'Update'}
                                    </Button>
                                </div>
                            </>
                        )}
                    </Form>
                </div>
            </div>
        </AppLayout>
    );
}

