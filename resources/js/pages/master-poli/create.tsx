import MasterPoliController from '@/actions/App/Http/Controllers/MasterPoliController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Master Poli',
        href: MasterPoliController.index().url,
    },
    {
        title: 'Tambah Poli',
        href: MasterPoliController.create().url,
    },
];

export default function Create() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Poli" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Tambah Data Poli" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...MasterPoliController.store.form()} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="kode_poli">
                                        Kode Poli <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="kode_poli"
                                        name="kode_poli"
                                        required
                                        placeholder="Contoh: POLI001"
                                    />
                                    <InputError message={errors.kode_poli} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="nama_poli">
                                        Nama Poli <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="nama_poli"
                                        name="nama_poli"
                                        required
                                        placeholder="Contoh: Poli Umum, Poli Gigi, dll"
                                    />
                                    <InputError message={errors.nama_poli} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="lokasi">
                                        Lokasi
                                    </Label>
                                    <Input
                                        id="lokasi"
                                        name="lokasi"
                                        placeholder="Contoh: Lantai 1, Gedung A"
                                    />
                                    <InputError message={errors.lokasi} />
                                </div>

                                <div className="flex justify-between">
                                    <Link href={MasterPoliController.index().url}>
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

