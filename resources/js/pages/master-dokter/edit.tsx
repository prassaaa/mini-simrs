import MasterDokterController from '@/actions/App/Http/Controllers/MasterDokterController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterDokter } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';

interface Props {
    dokter: MasterDokter;
}

const breadcrumbs = (dokter: MasterDokter): BreadcrumbItem[] => [
    {
        title: 'Master Dokter',
        href: MasterDokterController.index().url,
    },
    {
        title: 'Edit Dokter',
        href: MasterDokterController.edit(dokter.id).url,
    },
];

export default function Edit({ dokter }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs(dokter)}>
            <Head title="Edit Dokter" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Edit Data Dokter" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...MasterDokterController.update.form(dokter.id)} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="kode_dokter">
                                        Kode Dokter <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="kode_dokter"
                                        name="kode_dokter"
                                        defaultValue={dokter.kode_dokter}
                                        required
                                    />
                                    <InputError message={errors.kode_dokter} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="nama_dokter">
                                        Nama Dokter <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="nama_dokter"
                                        name="nama_dokter"
                                        defaultValue={dokter.nama_dokter}
                                        required
                                    />
                                    <InputError message={errors.nama_dokter} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="spesialisasi">
                                        Spesialisasi <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="spesialisasi"
                                        name="spesialisasi"
                                        defaultValue={dokter.spesialisasi}
                                        required
                                    />
                                    <InputError message={errors.spesialisasi} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="no_telp">
                                        No. Telepon
                                    </Label>
                                    <Input
                                        id="no_telp"
                                        name="no_telp"
                                        defaultValue={dokter.no_telp || ''}
                                    />
                                    <InputError message={errors.no_telp} />
                                </div>

                                <div className="flex justify-between">
                                    <Link href={MasterDokterController.index().url}>
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

