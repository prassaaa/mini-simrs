import MasterPoliController from '@/actions/App/Http/Controllers/MasterPoliController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type MasterPoli } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';

interface Props {
    poli: MasterPoli;
}

const breadcrumbs = (poli: MasterPoli): BreadcrumbItem[] => [
    {
        title: 'Master Poli',
        href: MasterPoliController.index().url,
    },
    {
        title: 'Edit Poli',
        href: MasterPoliController.edit(poli.id).url,
    },
];

export default function Edit({ poli }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs(poli)}>
            <Head title="Edit Poli" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Edit Data Poli" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...MasterPoliController.update.form(poli.id)} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="kode_poli">
                                        Kode Poli <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="kode_poli"
                                        name="kode_poli"
                                        defaultValue={poli.kode_poli}
                                        required
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
                                        defaultValue={poli.nama_poli}
                                        required
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
                                        defaultValue={poli.lokasi || ''}
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

