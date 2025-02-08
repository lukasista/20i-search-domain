import { registerBlockType } from '@wordpress/blocks';
import { useState } from '@wordpress/element';
import { TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType('domain-search/block', {
    title: __('20i Domain Search', 'domain-search'),
    icon: 'search',
    category: 'widgets',
    attributes: {
        domain: { type: 'string', default: '' },
        result: { type: 'string', default: '' }
    },
    edit: ({ attributes, setAttributes }) => {
        const [loading, setLoading] = useState(false);

        const searchDomain = () => {
            setLoading(true);
            setTimeout(() => {
                setAttributes({ result: `Available: ${attributes.domain}.com` });
                setLoading(false);
            }, 1000);
        };

        return (
            <div>
                <TextControl
                    label={__('Enter domain name', 'domain-search')}
                    value={attributes.domain}
                    onChange={(value) => setAttributes({ domain: value })}
                />
                <Button isPrimary onClick={searchDomain} disabled={loading}>
                    {loading ? __('Searching...', 'domain-search') : __('Search', 'domain-search')}
                </Button>
                {attributes.result && <p>{attributes.result}</p>}
            </div>
        );
    },
    save: () => {
        return <p>{__('Domain search block', 'domain-search')}</p>;
    }
});
