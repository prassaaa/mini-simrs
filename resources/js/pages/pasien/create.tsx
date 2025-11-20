import PasienController from '@/actions/App/Http/Controllers/PasienController';
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
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Data Pasien',
        href: PasienController.index().url,
    },
    {
        title: 'Tambah Pasien',
        href: PasienController.create().url,
    },
];

export default function Create() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Pasien" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Tambah Data Pasien" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...PasienController.store.form()} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="no_rm">
                                        No. RM <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="no_rm"
                                        name="no_rm"
                                        required
                                        placeholder="Masukkan nomor rekam medis"
                                    />
                                    <InputError message={errors.no_rm} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="nama_pasien">
                                        Nama Pasien <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="nama_pasien"
                                        name="nama_pasien"
                                        required
                                        placeholder="Masukkan nama pasien"
                                    />
                                    <InputError message={errors.nama_pasien} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="tanggal_lahir">
                                        Tanggal Lahir <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="tanggal_lahir"
                                        name="tanggal_lahir"
                                        type="date"
                                        required
                                    />
                                    <InputError message={errors.tanggal_lahir} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="jenis_kelamin">
                                        Jenis Kelamin <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="jenis_kelamin" required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih jenis kelamin" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="L">Laki-laki</SelectItem>
                                            <SelectItem value="P">Perempuan</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.jenis_kelamin} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="alamat">
                                        Alamat <span className="text-destructive">*</span>
                                    </Label>
                                    <Textarea
                                        id="alamat"
                                        name="alamat"
                                        required
                                        placeholder="Masukkan alamat lengkap"
                                        rows={4}
                                    />
                                    <InputError message={errors.alamat} />
                                </div>

                                <div className="flex justify-between">
                                    <Link href={PasienController.index().url}>
                                        <Button type="button" variant="outline">
                                            Kembali
                                        </Button>
                                    </Link>
                                    <Button type="submit" disabled={processing}>
                                        {processing ? 'Menyimpan...' : 'Simpan'}
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

